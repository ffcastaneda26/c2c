
    @include('inventory.vehicle_record_head_page')
    <div class="bg-white flex">
        <img class="stnd skip-lazy mb-2 h-16 w-20 sm:h-8 sm:w-16 2xl:h-32 2xl:w-56 ml-2"  alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
        <div>
            <a style="background-color:#edc628"  href="https://ctcautogroup.com/approval-new/"
                class="block right-10 absolute top-4 text-black 2xl:px-4 2xl:py-2  sm:px-2 font-bold rounded-lg hover:text-white">
                <span class="menu-title-text">{{__('GET APPROVED')}}</span>
            </a>
        </div>
    </div>
    <div id="ajax-content-wrap">
        @include('inventory.vehicle_record_data_images')

        @include('inventory.vehicle_record_details')

        @include('inventory.vehicle_record_footer')

    </div>
</body>
<script src="https://api.dealermade-next.com/v4/system-services/dm-next-hd-viewer-loader" async=""></script>
</html>
