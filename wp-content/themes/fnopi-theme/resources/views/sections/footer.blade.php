<footer class="content-info border-t border-t-fnopi-gray pt-[100px] " id="fnopi-footer">

    <div class="grid lg:grid-cols-2 gap-6 alignwide mx-auto px-6 lg:px-[60px] 2xl:px-[120px]">
        <div class="hidden lg:block">
            @if ($footer_title = get_field('footer_title','options'))
            <p class="font-fnopi-heading text-4xl leading-relaxed tracking-tight mb-12">
                {!!$footer_title!!}
            </p>
            @endif
            {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => '', 'echo' => false]) !!}
        </div>
        <div class="flex lg:justify-end justify-center">
            @if ($footer_quote = get_field('footer_quote','options'))
            <p class="text-center lg:text-left font-fnopi-heading text-2xl lg:text-5xl tracking-tight text-fnopi-dark-green max-w-[600px]">
                {!!$footer_quote!!}
            </p>
            @endif
        </div>
    </div>
    
    <div class="text-center lg:text-right mt-12 px-6 lg:px-[60px] 2xl:px-[120px]">
        
        @if ($contact_link = get_field('contact_link','options'))
            <a class="font-fnopi-heading italic text-4xl lg:text-5xl tracking-tight" href=" {{$contact_link['url']}}">
                {{$contact_link['title']}}
            </a>
        @endif
    </div>

    <div class="border-t border-t-fnopi-gray py-6">

        <div class="alignwide mx-auto px-6 lg:px-[60px] 2xl:px-[120px] flex flex-col lg:flex-row items-center lg:items-end justify-between">

            <div class="flex gap-4 lg:gap-10 items-center lg:items-end flex-col lg:flex-row">
                <a href="http://" target="_blank" rel="noopener noreferrer">
                    <img class="w-[215px] h-auto" src="{{asset('/images/fnopi-logo.png')}}" alt="FNOPI">
                </a>

                <p class="text-sm">©{{date('Y')}} FNOPI</p>
                <ul class="flex gap-3 uppercase text-sm">
                    <li>
                        <a class="hover:underline iubenda-nostyle no-brand iubenda-noiframe iubenda-embed iubenda-noiframe" title="Privacy Policy " href="https://www.iubenda.com/privacy-policy/75861204">Privacy Policy</a>
                    </li>
                    <li>
                       |
                    </li>
                    <li>
                        <a class="hover:underline iubenda-nostyle no-brand iubenda-noiframe iubenda-embed iubenda-noiframe" title="Cookie Policy " href="https://www.iubenda.com/privacy-policy/75861204/cookie-policy">Cookie Policy</a>
                    </li>
                </ul>
            </div>

            <div class="text-right mt-6 lg:mt-0">
                <p class="text-sm">Design & Development: <a href="https://" target="_blank" rel="noopener noreferrer">VIVA!</a></p>
            </div>
            
        </div>
    </div>


    <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
    <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
</footer>
