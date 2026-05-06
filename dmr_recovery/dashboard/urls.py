from django.urls import path
from django.contrib.auth import views as auth_views
from . import views
from . import cart_views

from .forms import CustomSetPasswordForm

app_name = 'dashboard'

urlpatterns = [
    path('', views.home, name='home'),
    path('bulk-delete/', views.bulk_delete_view, name='bulk_delete'),
    path('login/', views.login_view, name='login'),
    path('logout/', views.logout_view, name='logout'),
    path('settings/site/', views.site_settings_view, name='site_settings'),
    path('settings/home/', views.home_content_view, name='home_content'),
    path('settings/smtp/', views.smtp_settings_view, name='smtp_settings'),
    path('settings/smtp/', views.smtp_settings_view, name='smtp_settings'),
    path('profile/', views.admin_profile, name='admin_profile'),
    
    # Password Reset
    path('password_reset/', 
         auth_views.PasswordResetView.as_view(
             template_name='dashboard/password_reset.html',
             email_template_name='dashboard/password_reset_email.html',
             subject_template_name='dashboard/password_reset_subject.txt',
             success_url='/dashboard/password_reset/done/'
         ), 
         name='password_reset'),
    path('password_reset/done/', 
         auth_views.PasswordResetDoneView.as_view(
             template_name='dashboard/password_reset_done.html'
         ), 
         name='password_reset_done'),
    path('reset/<uidb64>/<token>/', 
         auth_views.PasswordResetConfirmView.as_view(
             template_name='dashboard/password_reset_confirm.html',
             success_url='/dashboard/reset/done/',
             form_class=CustomSetPasswordForm
         ), 
         name='password_reset_confirm'),
    path('reset/done/', 
         auth_views.PasswordResetCompleteView.as_view(
             template_name='dashboard/password_reset_complete.html'
         ), 
         name='password_reset_complete'),
    
    # Catalog - Products
    path('products/', views.product_list, name='product_list'),
    path('products/add/', views.product_create, name='product_create'),
    path('products/<int:pk>/edit/', views.product_edit, name='product_edit'),
    path('products/<int:pk>/delete/', views.product_delete, name='product_delete'),
    
    # Catalog - Brands
    path('brands/', views.brand_list, name='brand_list'),
    path('brands/add/', views.brand_create, name='brand_create'),
    path('brands/<int:pk>/edit/', views.brand_edit, name='brand_edit'),
    path('brands/<int:pk>/delete/', views.brand_delete, name='brand_delete'),

    # Enquiries
    path('enquiries/', views.enquiry_list, name='enquiry_list'),
    path('enquiries/export/', views.enquiries_export, name='enquiries_export'),
    path('enquiries/<int:pk>/', views.enquiry_detail, name='enquiry_detail'),
    path('enquiries/<int:pk>/delete/', views.enquiry_delete, name='enquiry_delete'),

    # User Carts
    path('user-carts/', cart_views.user_carts_list, name='dashboard_carts_list'),
    path('user-carts/export/', cart_views.user_carts_export, name='dashboard_carts_export'),
    path('user-carts/<int:cart_id>/', cart_views.user_cart_detail, name='dashboard_cart_detail'),
    path('user-carts/<int:cart_id>/delete/', cart_views.user_cart_delete, name='dashboard_cart_delete'),

    # Leads
    path('leads/', views.lead_list, name='lead_list'),
    path('leads/export/', views.leads_export, name='leads_export'),

    # Newsletter
    path('newsletter/', views.newsletter_list, name='newsletter_list'),
    path('newsletter/export/', views.newsletter_export, name='export_newsletter_subscribers'),
    path('newsletter/send/', views.newsletter_send, name='newsletter_send'),
    path('newsletter/<int:pk>/delete/', views.newsletter_delete, name='newsletter_delete'),
    # Hero Banners
    path('banners/', views.banner_list, name='banner_list'),
    path('banners/add/', views.banner_create, name='banner_create'),
    path('banners/<int:pk>/edit/', views.banner_edit, name='banner_edit'),
    path('banners/<int:pk>/delete/', views.banner_delete, name='banner_delete'),
]
