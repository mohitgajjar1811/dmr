from django.shortcuts import render, get_object_or_404
from django.core.paginator import Paginator
from django.db.models import Q
from .models import Product
from brands.models import Brand

def product_list(request):
    products = Product.objects.filter(is_active=True).order_by('-created_at')
    
    # Filters
    brand_slug = request.GET.get('brand')
    query = request.GET.get('q')
    
    if brand_slug:
        products = products.filter(brand__slug=brand_slug)
        
    if query:
        products = products.filter(Q(name__icontains=query) | Q(description__icontains=query))

    # Pagination
    paginator = Paginator(products, 12) # 12 per page
    page_number = request.GET.get('page')
    page_obj = paginator.get_page(page_number)
    
    context = {
        'page_obj': page_obj,
        'brands': Brand.objects.all(),
    }
    return render(request, 'products/product_list.html', context)

def product_detail(request, slug):
    product = get_object_or_404(Product, slug=slug, is_active=True)
    if product.brand:
        related_products = Product.objects.filter(brand=product.brand, is_active=True).exclude(id=product.id)[:4]
    else:
        related_products = Product.objects.filter(is_active=True).exclude(id=product.id)[:4]
    
    cart_qty = 0
    if request.session.session_key:
        from cart.models import CartItem
        try:
            cart_item = CartItem.objects.get(cart__session_key=request.session.session_key, product=product)
            cart_qty = cart_item.quantity
        except CartItem.DoesNotExist:
            pass

    context = {
        'product': product,
        'related_products': related_products,
        'cart_qty': cart_qty,
    }
    return render(request, 'products/product_detail.html', context)

