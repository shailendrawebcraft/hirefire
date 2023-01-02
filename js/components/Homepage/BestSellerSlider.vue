<template>
    <div>
        <div :key="Math.random().toString(36).substring(7)"
            class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

            <div v-for="bestseller in bestseller" :key="bestseller.id" class="item item-carousel">

                <div class="products">
                    <div v-if="starbadge == true"  class="starBadge">
                        <div class="ribbon2 down" style="color: #fd9c2e;">
                            <div class="content2">
                                <svg width="24px" height="24px" aria-hidden="true" focusable="false" data-prefix="far" data-icon="star" class="svg-inline--fa fa-star fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path fill="currentColor" d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                   
                    <div class="product">

        
                        <div class="product-image">
                            <div class="image">

                                <a :href="bestseller.bestsellerurl" :title="bestseller.name  &&  bestseller.name">
                                    
                                    <span v-if="bestseller.image">
                                        <img class="owl-lazy"
                                            :data-src="`${baseUrl}/images/user/${bestseller.image}`" @error="onImageLoadFailure($event)" alt="product_image" />
                                    </span>


                                    <span v-else>
                                        <img class="owl-lazy"
                                            :title="bestseller.name && bestseller.name"
                                            :src="baseUrl+'/images/user.png'" style="opacity: 1" alt="No Image" />
                                    </span>

                                </a>
                            </div>

                        </div>


                        <!-- /.product-image -->

                        <div class="product-info" :class="{'text-left' : rtl == false, 'text-right' : rtl == true}">
                            <h3 class="text-truncate name">
                                {{ bestseller.name}}
                            </h3>

                        </div>
                    </div>
                    <!-- /.product -->

                </div>
                <!-- /.products -->
            </div>  
            <!-- /.item -->
        </div>

    </div>

</template>

<script>
    axios.defaults.baseURL = baseUrl;
    export default {
        props: ['products', 'date', 'lang', 'fallbacklang', 'login', 'guest_price','simple_products','starbadge','bestseller'],

        data(){
            return {
                rtl : rtl,
                baseUrl : baseUrl
            }
        },
        methods: {

            onImageLoadFailure (event) {
                event.target.src = baseUrl+'/images/user.png'
            },

            installOwlCarousel(rtl) {
                
                $('.home-owl-carousel').each(function () {

                    var owl = $(this);

                    var itemPerLine = owl.data('item');

                    if (!itemPerLine) {
                        itemPerLine = 4;
                    }
                    owl.owlCarousel({
                        items: 3,
                        itemsTablet: [978, 1],
                        itemsDesktopSmall: [979, 2],
                        itemsDesktop: [1199, 1],
                        nav: true,
                        rtl: rtl,
                        slideSpeed: 300,
                        margin: 10,
                        pagination: false,
                        lazyLoad: true,
                        navText: ["<i class='icon fa fa-angle-left'></i>",
                            "<i class='icon fa fa-angle-right'></i>"
                        ],
                        responsiveClass: true,
                        responsive: {
                            0: {
                                items: 3,
                                nav: false,
                                dots: false,
                            },
                            600: {
                                items: 3,
                                nav: false,
                                dots: false,
                            },
                            768: {
                                items: 4,
                                nav: false,
                            },
                            1100: {
                                items: 5,
                                nav: true,
                                dots: true,
                            }
                        }
                    });
                });
            },

            createOwl() {

                var vm = this;

                this.$nextTick(() => {
                 vm.installOwlCarousel(this.rtl);
                });
                

            },
        },
        created() {

            this.createOwl();

        }


    }
</script>
