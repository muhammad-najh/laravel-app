<!-- Header Top -->
<div class="header-top">
    <div class="inner-container">

        <div class="top-left">
            <!-- Info List -->
            <ul class="list-style-one">
                @if($global_setting->top_bar_email != '')
                <li ><i class="fa fa-envelope"></i> <a href="mailto:{{ $global_setting->top_bar_email }}">{{ $global_setting->top_bar_email }}</a></li>
                @endif

                @if($global_setting->top_bar_address != '')
                <li ><i class="fa fa-map-marker"></i> {{ $global_setting->top_bar_address }}</li>
                @endif
            </ul>
        </div>

        <div class="top-right">
            <ul class="useful-links">
                <li ><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                <li ><a href="{{ route('faqs') }}">{{ __('FAQ') }}</a></li>
                <li ><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
            </ul>

            @if($global_setting->twitter!=''||$global_setting->facebook!=''||$global_setting->linkedin!=''||$global_setting->instagram!=''||$global_setting->youtube!=''||$global_setting->pinterest)
            <ul class="social-icon-one">
                @if($global_setting->twitter!='')
                <li ><a href="{{ $global_setting->twitter }}"><span class="fab fa-twitter"></span></a></li>
                @endif

                @if($global_setting->facebook!='')
                <li ><a href="{{ $global_setting->facebook }}"><span class="fab fa-facebook-f"></span></a></li>
                @endif

                @if($global_setting->linkedin!='')
                <li ><a href="{{ $global_setting->linkedin }}"><span class="fab fa-linkedin-in"></span></a></li>
                @endif

                @if($global_setting->instagram!='')
                <li ><a href="{{ $global_setting->instagram }}"><span class="fab fa-instagram"></span></a></li>
                @endif

                @if($global_setting->youtube!='')
                <li ><a href="{{ $global_setting->youtube }}"><span class="fab fa-whatsapp"></span></a></li>
                @endif

                @if($global_setting->pinterest!='')
                <li ><a href="{{ $global_setting->pinterest }}"><span class="fab fa-whatsapp"></span></a></li>
                @endif
            </ul>
            @endif
        </div>
    </div>
    
</div>
<!-- Header Top -->

<script>
// Check viewport width on page load and resize
function checkViewportWidth() {
    var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
    
    // Define the maximum width for mobile devices (adjust as needed)
    var maxWidthForMobile = 768;
    
    // Select the language icon element
    var languageIcon = document.querySelector('.language-icon');
    
    // Check if viewport width is less than or equal to the maximum width for mobile
    if (viewportWidth <= maxWidthForMobile) {
        // Hide the language icon
        languageIcon.style.display = 'none';
    } else {
        // Ensure the language icon is visible
        languageIcon.style.display = 'block';
    }
}

// Run the function on page load and when the window is resized
window.onload = checkViewportWidth;
window.onresize = checkViewportWidth;
</script>