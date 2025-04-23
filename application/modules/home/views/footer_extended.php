<?php defined('BASEPATH') OR exit('No direct script access allowed');
// Get the map provider setting from database
$map_provider = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row()->map_provider;
?>

<!-- Common Styling for both map providers -->
<style>
/* Autocomplete Container Styling */
.pac-container, .osm-container {
    z-index: 10000 !important;
    border-radius: 4px;
    border: 1px solid #ddd;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    font-family: inherit;
    font-size: 14px;
    margin-top: 2px;
}

.pac-item, .osm-item {
    padding: 8px 12px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.pac-item:hover, .osm-item:hover {
    background-color: #f5f5f5;
}

.pac-item-selected, .osm-item-selected {
    background-color: #f0f0f0;
}

.pac-matched, .osm-matched {
    font-weight: bold;
}

input[name="address"] {
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px;
    padding-right: 35px !important;
}

input[name="address"]:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* OpenStreetMap specific styles */
.osm-container {
    position: absolute;
    background: white;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    display: none;
}

.osm-item {
    border-bottom: 1px solid #eee;
}
</style>

<!-- Map Provider Scripts -->
<script>
// Initialize Google Places Autocomplete
function initGooglePlacesAutocomplete() {
    const addressFields = document.querySelectorAll('input[name="address"]');
    addressFields.forEach(function(field) {
        const autocomplete = new google.maps.places.Autocomplete(field, {
            types: ['address']
        });
        
        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            if (!place.geometry) return;
            field.value = place.formatted_address;
            const event = new Event('change', { bubbles: true });
            field.dispatchEvent(event);
        });
    });
}

// Initialize OpenStreetMap Autocomplete
function initOpenStreetMapAutocomplete() {
    const addressFields = document.querySelectorAll('input[name="address"]');
    
    addressFields.forEach(function(field) {
        // Create container for results
        const container = document.createElement('div');
        container.className = 'osm-container';
        field.parentNode.style.position = 'relative';
        field.parentNode.appendChild(container);
        
        let timeoutId;
        
        field.addEventListener('input', function() {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                const query = this.value;
                if (query.length < 3) {
                    container.style.display = 'none';
                    return;
                }
                
                // Call Nominatim API
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        container.innerHTML = '';
                        data.forEach(result => {
                            const div = document.createElement('div');
                            div.className = 'osm-item';
                            div.textContent = result.display_name;
                            div.addEventListener('click', () => {
                                field.value = result.display_name;
                                container.style.display = 'none';
                                const event = new Event('change', { bubbles: true });
                                field.dispatchEvent(event);
                            });
                            container.appendChild(div);
                        });
                        container.style.display = data.length ? 'block' : 'none';
                    });
            }, 300);
        });
        
        // Hide container when clicking outside
        document.addEventListener('click', function(e) {
            if (!field.contains(e.target) && !container.contains(e.target)) {
                container.style.display = 'none';
            }
        });
    });
}

// Initialize based on selected provider
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($map_provider === 'google'): ?>
    // Load Google Places API
    const script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDQe03FIisHmaZqxPYFRaW2x_jVyxcIdGY&libraries=places&callback=initGooglePlacesAutocomplete';
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
    <?php else: ?>
    // Initialize OpenStreetMap
    initOpenStreetMapAutocomplete();
    <?php endif; ?>
});
</script> 