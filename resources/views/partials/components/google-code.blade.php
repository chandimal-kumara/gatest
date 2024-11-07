@php
  include get_template_directory() . "/google-analytics-id.php";
  echo "<script>var tempAnalyticIDValue = '$googleAnalyticsId';</script>";
@endphp

<script>
  let cookiePreferences = getCookie('popupCookieAllowed').split(',');
  if (cookiePreferences[0] == 'necessary%2Cperformance%2Cfunctional%2Ctargetting') {
    cookiePreferences = cookiePreferences[0].split('%2C');
  }

  const analyticsID = tempAnalyticIDValue;

  if (analyticsID.length > 1) {
    // Check for Button Clicks and Load Google Analytics
    window.addEventListener('DOMContentLoaded', () => {
      const acceptAllButton = document.getElementById('accept-all-button');
      const confirmPreferencesButton = document.getElementById('confirm-preferences');

      if (acceptAllButton) {
        acceptAllButton.addEventListener('click', () => {
          setAnalytics();
        });
      }

      if (confirmPreferencesButton) {
        confirmPreferencesButton.addEventListener('click', () => {
          if (document.getElementById("performance-cookies-toggle").checked === true) {
            setAnalytics();
          }
        });
      }
    });
    // Check for Button Clicks and Load Google Analytics

    // On-Load Check Cookie Consent and Load Google Analytics
    if(getCookie('popupCookie') == 'submited' && cookiePreferences.includes('performance')){
      setAnalytics();
    } else {
      deleteAnalyticCookies();
    }
    // On-Load Check Cookie Consent and Load Google Analytics
  }

  function setAnalytics() {
    var addGoogleAnalytics = document.createElement("script");
    addGoogleAnalytics.setAttribute("src",`https://www.googletagmanager.com/gtag/js?id=${analyticsID}`);
    addGoogleAnalytics.async = "true";
    document.head.appendChild(addGoogleAnalytics);

    var addDataLayer = document.createElement("script");
    var dataLayerData = document.createTextNode(`window.dataLayer = window.dataLayer || []; \n function gtag(){dataLayer.push(arguments);} \n gtag('js', new Date()); \n gtag('config', '${analyticsID}');`);
    addDataLayer.appendChild(dataLayerData);
    document.head.appendChild(addDataLayer);
  }

  function deleteAnalyticCookies() {
    deleteCookie('_ga');
    deleteCookie('_ga_EXFNGAKKTZ');
  }

  // Get Cookie Values
  function getCookie(cname) {
    var name = cname + '=';
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return '';
  }
  // Get Cookie Values

  // Delete Cookies
  function deleteCookie(cname) {
    document.cookie = cname+'=; Max-Age=-99999999;';
  }
  // Delete Cookies
</script>