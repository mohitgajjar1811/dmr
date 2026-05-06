from .models import CompanyInfo, HomePageContent, HomeFeature

def site_settings(request):
    """
    Returns global site settings and home page content.
    """
    return {
        'company_info': CompanyInfo.objects.first(),
        'home_content': HomePageContent.objects.first(),
        'home_features': HomeFeature.objects.all(),
    }

