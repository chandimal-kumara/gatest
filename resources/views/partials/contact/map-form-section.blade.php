@php
  $locations = get_field('site_locations','options');
  $socials = get_field('site_social_links','options');
  $eyebrowHeading = get_field('contact_form_eyebrow_heading');
  $heading = get_field('contact_form_heading');
  $subHeading = get_field('contact_form_sub_heading');
  $contactShortcode = get_field('contact_form_shortcode');
@endphp

{{-- Google Map Start --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXCgdLb0Rpd0xLmyMwOURVz6VjG236y_w"></script>
<script type="text/javascript">
  (function($) {
    function initMap($el) {
      // Find marker elements within map.
      var $markers = $el.find('.marker');
      const image = "/wp-content/themes/roots/dist/images/map-marker.svg";
      // var $markers = "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
      // Create gerenic map.
      var mapArgs = {
        zoom: $el.data('zoom') || 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        icon: image,
        styles: [
                    {
                      "elementType": "geometry",
                      "stylers": [
                        {
                          "color": "#f5f5f5"
                        }
                      ]
                    },
                    {
                      "elementType": "geometry.fill",
                      "stylers": [
                        {
                          "color": "#edf1f8"
                        }
                      ]
                    },
                    {
                      "elementType": "labels.icon",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "elementType": "labels.text.fill",
                      "stylers": [
                        {
                          "color": "#616161"
                        }
                      ]
                    },
                    {
                      "elementType": "labels.text.stroke",
                      "stylers": [
                        {
                          "color": "#f5f5f5"
                        }
                      ]
                    },
                    {
                      "featureType": "administrative",
                      "elementType": "geometry",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "featureType": "administrative.land_parcel",
                      "elementType": "labels",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "featureType": "administrative.land_parcel",
                      "elementType": "labels.text.fill",
                      "stylers": [
                        {
                          "color": "#bdbdbd"
                        }
                      ]
                    },
                    {
                      "featureType": "poi",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "featureType": "poi",
                      "elementType": "geometry",
                      "stylers": [
                        {
                          "color": "#eeeeee"
                        }
                      ]
                    },
                    {
                      "featureType": "poi",
                      "elementType": "labels.text",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "featureType": "poi",
                      "elementType": "labels.text.fill",
                      "stylers": [
                        {
                          "color": "#757575"
                        }
                      ]
                    },
                    {
                      "featureType": "poi.park",
                      "elementType": "geometry",
                      "stylers": [
                        {
                          "color": "#e5e5e5"
                        }
                      ]
                    },
                    {
                      "featureType": "poi.park",
                      "elementType": "labels.text.fill",
                      "stylers": [
                        {
                          "color": "#9e9e9e"
                        }
                      ]
                    },
                    {
                      "featureType": "road",
                      "elementType": "geometry",
                      "stylers": [
                        {
                          "color": "#ffffff"
                        }
                      ]
                    },
                    {
                      "featureType": "road",
                      "elementType": "labels.icon",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "featureType": "road.arterial",
                      "elementType": "labels.text.fill",
                      "stylers": [
                        {
                          "color": "#757575"
                        }
                      ]
                    },
                    {
                      "featureType": "road.highway",
                      "elementType": "geometry",
                      "stylers": [
                        {
                          "color": "#dadada"
                        }
                      ]
                    },
                    {
                      "featureType": "road.highway",
                      "elementType": "labels.text.fill",
                      "stylers": [
                        {
                          "color": "#616161"
                        }
                      ]
                    },
                    {
                      "featureType": "road.local",
                      "elementType": "labels",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "featureType": "road.local",
                      "elementType": "labels.text.fill",
                      "stylers": [
                        {
                          "color": "#9e9e9e"
                        }
                      ]
                    },
                    {
                      "featureType": "transit",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "featureType": "transit.line",
                      "elementType": "geometry",
                      "stylers": [
                        {
                          "color": "#e5e5e5"
                        }
                      ]
                    },
                    {
                      "featureType": "transit.station",
                      "elementType": "geometry",
                      "stylers": [
                        {
                          "color": "#eeeeee"
                        }
                      ]
                    },
                    {
                      "featureType": "water",
                      "elementType": "geometry",
                      "stylers": [
                        {
                          "color": "#c9c9c9"
                        }
                      ]
                    },
                    {
                      "featureType": "water",
                      "elementType": "labels.text.fill",
                      "stylers": [
                        {
                          "color": "#9e9e9e"
                        }
                      ]
                    }
                  ]
      };
      var map = new google.maps.Map($el[0], mapArgs);
      // Add markers.
      map.markers = [];
      $markers.each(function() {
        initMarker($(this), map);
      });
      // Center map based on markers.
      centerMap(map);
      // Return map instance.
      return map;
    }

    function initMarker($marker, map) {
      // Get position from marker.
      var lat = $marker.data('lat');
      var lng = $marker.data('lng');
      var latLng = {
        lat: parseFloat(lat),
        lng: parseFloat(lng)
      };
      // Create marker instance.
      var image2 = "/wp-content/themes/roots/dist/images/map-marker.svg";
      var marker = new google.maps.Marker({
        position: latLng,
        map: map,
        icon: image2,
        label: { color: '#000000', fontWeight: 'bold', fontSize: '16px', className: 'label-position' , text: 'Smashy Design (Pvt) Ltd.' },
        // title: "Hello world",
      });
      // Append to reference for later use.
      map.markers.push(marker);
      // If marker contains HTML, add it to an infoWindow.
      if ($marker.html()) {
        // Create info window.
        var infowindow = new google.maps.InfoWindow({
          content: $marker.html()
        });
        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
        });
      }
    }

    function centerMap(map) {
      // Create map boundaries from all map markers.
      var bounds = new google.maps.LatLngBounds();
      map.markers.forEach(function(marker) {
        bounds.extend({
          lat: marker.position.lat(),
          lng: marker.position.lng()
        });
      });
      // Case: Single marker.
      if (map.markers.length == 1) {
        map.setCenter(bounds.getCenter());
        // Case: Multiple markers.
      } else {
        map.fitBounds(bounds);
      }
    }

    // Render maps on page load.
    $(document).ready(function() {
      $('.acf-map').each(function() {
        var map = initMap($(this));
      });
    });

  })(jQuery);
</script>

<section class="contact-section contact-map-section">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-6 content-map-wrp">
        <div class="map-wrp">
          @if (count($locations) == 1)
          <div class="google-map">
            @foreach ($locations as $location)
              @php
                $map = $location['locations_map'];
              @endphp
              <div class="map-content">
                <div class="acf-map" data-zoom="16">
                  <div class="marker" data-lat="<?php echo esc_attr($map['lat']); ?>" data-lng="<?php echo esc_attr($map['lng']); ?>"></div>
                </div>
              </div>
            @endforeach
          </div>
          <div class="address-wrp">
            <h4>Visit us</h4>
            @foreach ($locations as $location)
              @php
                $address = $location['locations_address'];
              @endphp
              <div class="address-content">
                <p>@php echo $address; @endphp</p>
              </div>
            @endforeach
          </div>
          <div class="contacts-wrp">
            <h4>Chat to Us</h4>
            @foreach ($locations as $location)
              @php
                $contactNumber = $location['locations_phone'];
                $email = $location['locations_email'];
              @endphp
              <div class="address-content">
                <p>@php echo $contactNumber; @endphp</p>
                <p>@php echo $email; @endphp</p>
              </div>
            @endforeach
          </div>
          <div class="social-wrp">
            <h4>Follow Us</h4>
            <div class="social-items-wrp">
              @if ($socials)
                @foreach( $socials as $social )
                  @php
                    $smType = $social['socials_link_type'];
                    $smLink = $social['socials_link_url'];

                    if ($smType == 'facebook') {
                      $smTypeClass = 'fa-brands fa-facebook-f';
                    } else if ($smType == 'instagram') {
                      $smTypeClass = 'fa-brands fa-instagram';
                    } else if ($smType == 'twitter') {
                      $smTypeClass = 'fa-brands fa-x-twitter';
                    } else if ($smType == 'linkedin') {
                      $smTypeClass = 'fa-brands fa-linkedin-in';
                    } else {
                      $smTypeClass = '';
                    }
                  @endphp
                  <div class="footer-social-media-item">
                    @if ($smLink)
                      <a href="@php echo esc_url($smLink['url']); @endphp" target="_blank" class="@php echo $smTypeClass; @endphp">
                      </a>
                    @endif
                  </div>
                @endforeach
              @endif
            </div>
          </div>
          @elseif (count($locations) > 1)

              <h2>More Than One Map</h2>
            {{-- Add Code Here --}}

          @endif
        </div>
      </div>
      <div class="col-12 col-lg-6 content-form-wrp">
        <div class="contact-form-wrp">
          <span class="eyebrow-heading">@php echo $eyebrowHeading; @endphp</span>
          <h2>@php echo $heading; @endphp</h2>
          <span class="l-para">@php echo $subHeading; @endphp</span>
          <div class="form-section">
            @php echo do_shortcode($contactShortcode); @endphp
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
