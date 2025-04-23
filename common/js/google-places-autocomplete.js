/**
 * Google Places API integration for address fields
 * This script adds autocomplete functionality to all address input fields
 */

// Initialize Google Places Autocomplete on all address fields
function initGooglePlacesAutocomplete() {
    // Find all input fields with name="address"
    const addressFields = document.querySelectorAll('input[name="address"]');
    
    // Loop through each address field and add autocomplete
    addressFields.forEach(function(field) {
        // Create autocomplete instance for each field
        const autocomplete = new google.maps.places.Autocomplete(field, {
            types: ['address'],
            // You can restrict results to specific countries if needed
            // componentRestrictions: { country: ["us", "ca"] }
        });
        
        // When a place is selected, fill in the address field
        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a place that was not suggested
                return;
            }
            
            // Get the address components
            const addressComponents = place.address_components;
            
            // You can extract specific address components if needed
            // For example:
            // const streetNumber = getAddressComponent(addressComponents, 'street_number');
            // const route = getAddressComponent(addressComponents, 'route');
            
            // Set the formatted address to the input field
            field.value = place.formatted_address;
            
            // Trigger change event to notify any frameworks that the value has changed
            const event = new Event('change', { bubbles: true });
            field.dispatchEvent(event);
        });
    });
}

// Helper function to get specific address components
function getAddressComponent(components, type) {
    for (let i = 0; i < components.length; i++) {
        const component = components[i];
        const componentTypes = component.types;
        
        if (componentTypes.indexOf(type) !== -1) {
            return component.long_name;
        }
    }
    return '';
}

// Initialize when the Google Maps API is loaded
function loadGooglePlacesAPI() {
    // Get API key from the global variable or use a default placeholder
    const apiKey = typeof GOOGLE_API_KEY !== 'undefined' ? GOOGLE_API_KEY : 'YOUR_API_KEY';
    
    // Create script element
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places&callback=initGooglePlacesAutocomplete`;
    script.async = true;
    script.defer = true;
    
    // Append script to document
    document.head.appendChild(script);
}

// Load the Google Places API when the document is ready
document.addEventListener('DOMContentLoaded', loadGooglePlacesAPI); 