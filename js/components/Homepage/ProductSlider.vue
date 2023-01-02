<template>
    <div>

        <div :key="Math.random().toString(36).substring(7)"
            class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

            <div v-for="product in products" :key="Math.random().toString(36).substring(7)" class="item item-carousel">
                <div v-if="starbadge == false && product.sale_tag != null && product.sale_tag != '' && product.sale_tag[lang] != null" class="ribbon ribbon-top-right">
                   <span :style="{ 'background' : product.sale_tag_color, 'color' : product.sale_tag_text_color }">
                       
                       {{ product.sale_tag[lang]  ? product.sale_tag[lang] : product.sale_tag[fallbacklang] }}

                   </span>
                </div>

               

                <div class="products">

                    <div v-if="starbadge == true && product.featured == 1" class="starBadge">
                        <div class="ribbon2 down" style="color: #fd9c2e;">
                            <div class="content2">
                                <svg width="24px" height="24px" aria-hidden="true" focusable="false" data-prefix="far" data-icon="star" class="svg-inline--fa fa-star fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path fill="currentColor" d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                   
                    <div class="product">

                        <!-- <div class="badges bg-priamry">
                            <span>OFF<span>20%</span></span>
                        </div> -->
                        <div v-if="product.offerprice != 0 && product.offerprice != '0.00'" class="badges bg-priamry"> <span>OFF<span>{{ discountedPrice(product) }}</span></span>
                            </div>
                        <div class="product-image">
                            <div :class="{'pro-img-box' : product.stock == 0 }" class="image">

                                <a :href="product.producturl"
                                    :title="product.productname[lang]  ? product.productname[lang] : product.productname[fallbacklang]">
                                    

                                    <span v-if="product.thumbnail">
                                        <img class="owl-lazy" :class="{'filterdimage' : product.stock == 0}"
                                            :data-src="product.thumbnail" alt="product_image" />
                                        <img :class="{'filterdimage' : product.stock == 0 }"
                                            class="owl-lazy hover-image" :data-src="product.hover_thumbnail"
                                            alt="product_image" />
                                           <div v-if="product.offerprice != 0 && product.offerprice != '0.00'" class="badges bg-priamry"> <span>OFF<span>{{ discountedPrice(product) }}</span></span>
                                            </div>
                                    </span>


                                    <span v-else>
                                        <img :class="{'filterdimage' : product.stock == 0 }" class="owl-lazy"
                                            :title="product.productname[lang]  ? product.productname[lang] : product.productname[fallbacklang]"
                                            :src="`${baseurl}'/images/no-image.png'}`" alt="No Image" />
                                    </span>


                                </a>
                            </div>


                            <h6 v-if="product.stock == 0" align="center" class="oottext">
                                <span>{{ translate('staticwords.Outofstock') }}</span></h6>

                            <h6 v-if="product.pre_order == 1 && product.product_avbl_date >= date" align="center" class="preordertext">
                                <span>{{ translate('Available for preorder') }}</span>
                            </h6>

                            <h6 v-if="product.stock != 0 && product.selling_start_at != null && product.selling_start_at >= date"
                                align="center" class="oottext2"><span>{{ translate('staticwords.ComingSoon') }}</span>
                            </h6>
                            
                
                           

                           

                        </div>


                        <!-- /.product-image -->

                        <div class="product-info" :class="{'text-left' : rtl == false, 'text-right' : rtl == true}">
                            <h3 class="text-truncate name">
                                <a :href="product.producturl">{{ product.productname[lang]  ? product.productname[lang] : product.productname[fallbacklang] }}</a>
                            </h3>


                            <div v-if="product.rating != 0" :class="{'float-left' : rtl == false, 'float-right' : rtl == true}">
                                <div class="star-ratings-sprite"><span :style="{ 'width' : `${product.rating}%` }"
                                        class="star-ratings-sprite-rating"></span>
                                </div>
                            </div>

                            <div v-else class="no-rating">No Rating</div>

                            <!-- Product-price -->

                            <div v-if="guest_price == '0' || login == 1" class="product-price">
                                <span class="price">

                                    <div v-if="product.offerprice == 0 || product.offerprice == '0,00'">
                                        <span class="price">
                                            <span v-if="product.position == 'rs'">&nbsp;</span>
                                             <i v-if="product.position == 'r' || product.position == 'rs'" :class="product.symbol"></i>

                                                {{ product.mainprice }}
                                                

                                            <i v-if="product.position == 'l' || product.position == 'ls'" :class="product.symbol"></i>
                                            <span v-if="product.position == 'ls'">&nbsp;</span>
                                        </span>
                                    </div>


                                    <div v-else>
                                        <span class="price">
                                            <i v-if="product.position == 'l' || product.position == 'ls'" :class="product.symbol"></i>
                                            <span v-if="product.position == 'ls'">&nbsp;</span>

                                            <span v-if="product.position == 'rs'">&nbsp;</span>
                                            <i v-if="product.position == 'r' || product.position == 'rs'" :class="product.symbol"></i>
                                            
                                            {{ product.offerprice }}

                                        </span>
                                        <span class="price-before-discount">
                                            <i v-if="product.position == 'l' || product.position == 'ls'" :class="product.symbol"></i>
                                            <span v-if="product.position == 'ls'">&nbsp;</span>

                                            <span v-if="product.position == 'rs'">&nbsp;</span>
                                             <i v-if="product.position == 'r' || product.position == 'rs'" :class="product.symbol"></i>

                                            {{ product.mainprice }}


                                        </span>
                                    </div>

                                </span>
                            </div>

                            <!-- /.product-price -->

                        </div>

                        <div v-if="product.stock != 0 && product.selling_start_at != null && product.selling_start_at >= date">

                        </div>
                        <div v-else-if="product.pre_order == 1 && product.product_avbl_date >= date"> 
                            
                        </div>
                        <div v-else-if="product.stock != 0" class="cart clearfix animate-effect">
                            <div class="action">
                                <ul class="list-unstyled">

                                    <!-- Enquiry Form --> 

                                    <li v-show="guest_price == '0' || login == 1" id="enquireNow" class="lnk wishlist">

                                       
                                        <form @submit.prevent="enquireNow(product)">
                                            <button :title="translate('Enquire Now')" type="submit"
                                                class="addtocartcus btn" id="show-modal" data-toggle="modal" data-target="#userFormModal"><i class="fa fa-envelope"></i>
                                            </button>
                                        </form>
                                        
                                    </li>

                                    <!-- cart condition -->

                                    <!-- <li v-if="product.type != 'ex_product'" v-show="guest_price == '0' || login == 1" id="addCart" class="lnk wishlist">

                                       
                                        <form @submit.prevent="addToCart(product.productid)">
                                            <button :title="translate('staticwords.AddtoCart')" type="submit"
                                                class="addtocartcus btn"><i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                        

                                    </li> -->

                                    
                                    <!-- <li v-if="login == 1" :class="{'active' : product.is_in_wishlist == 1}" class="lnk wishlist"> -->

                                        <!-- Variant product add to cart system -->
                                        <!-- <form v-if="product.product_type == 'variant'" @submit.prevent="addtowish(product.variantid)">
                                            <button type="submit" :class="{'text-dark' : product.is_in_wishlist == 1}" class="addtocartcus btn"><i class="fa fa-heart"></i>
                                            </button>
                                        </form> -->
                                        
                                        <!-- Simple product add to cart system -->
                                        <!-- <form v-else @submit.prevent="addtowishsimple(product.productid)">
                                            <button type="submit" :class="{'text-dark' : product.is_in_wishlist == 1}" class="addtocartcus btn"><i class="fa fa-heart"></i>
                                            </button>
                                        </form> -->

                                    <!-- </li> -->


                                    <!-- <li class="lnk"> 
                                        <form @submit.prevent="addToCompare(product.productid)">
                                            <button :title="translate('staticwords.Compare')" type="submit"
                                                class="addtocartcus btn"><i class="fa fa-signal"></i>
                                            </button>
                                        </form>
                                    </li> -->
                                </ul>
                            </div>
                            <!-- /.action -->
                        </div>

                        <!-- /.cart -->
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
    import EventBus from '../../EventBus';
    axios.defaults.baseURL = baseUrl;
    export default {
        props: ['products', 'date', 'lang', 'fallbacklang', 'login', 'guest_price','simple_products','starbadge'],
        data(){
            return {
                rtl : rtl,
                baseUrl : baseUrl
            }
        },
        methods: {
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

            addToCart(cartURL) {
                axios.post(cartURL).then(res => {

                    if (res.data.status == 'success') {
                        let config = {
                            text: res.data.msg,
                            button: 'CLOSE'
                        }

                        EventBus.$emit('re-loadcart',1);
                        
                        this.$snack['success'](config);


                    } else {
                        let config = {
                            text: res.data.msg,
                            button: 'CLOSE'
                        }
                        this.$snack['danger'](config);
                    }

                }).catch(err => {

                    let config = {
                        text: 'Something went wrong !',
                        button: 'CLOSE'
                    }

                    this.$snack['danger'](config);

                    console.log(err)
                });
            },

            enquireNow(product) {
                console.log(product)
                EventBus.$emit('enquiry-request', product);
            },

            discountedPrice(product) {
                return Math.round(100*(product.mainprice - product.offerprice)/product.mainprice) + '%';
            },

            addToCompare(id){

                axios.post(`${baseUrl}/vue/add/to/comparison`,{
                    id : id
                })
                     .then(res => {


                            if (res.data.status == 'success') {
                                let config = {
                                    text: res.data.message,
                                    button: 'CLOSE'
                                }
                                this.$snack['success'](config);

                                EventBus.$emit('re-load-comparison',1);

                            } else {
                                let config = {
                                    text: res.data.message,
                                    button: 'CLOSE'
                                }
                                this.$snack['danger'](config);
                            }

                        }).catch(err => {
                            
                            let config = {
                                    text: "Something went wrong !",
                                    button: 'CLOSE'
                            }
                            this.$snack['danger'](config);

                        });
            },
            addtowish(id){

                
                axios.get('/vue/add_or_removewishlist/',{
                    params : {
                        variantid : id
                    }
                }).then(res => {

                    let config = {
                        text: res.data.message,
                        button: 'CLOSE'
                    }

                    if(res.data.status == 'fail'){
                        this.$snack['danger'](config);
                    }else{
                        this.$snack['success'](config);
                        EventBus.$emit('re-load-wish',1);
                    }   
                    

                }).catch(err => {
                    let config = {
                        text: 'Something went wrong !',
                        button: 'CLOSE'
                    }
                    this.$snack['danger'](config);
                    console.log(err);
                });


            },
            addtowishsimple(id){

                
                axios.get('add/simple_pro/',{
                    params : {
                        proid : id
                    }
                }).then(res => {

                    let config = {
                        text: res.data.msg,
                        button: 'CLOSE'
                    }

                    if(res.data.status == 'fail'){
                        this.$snack['danger'](config);
                    }else{
                        this.$snack['success'](config);
                        EventBus.$emit('re-load-wish',1);
                    }   
                    

                }).catch(err => {
                    let config = {
                        text: 'Something went wrong !',
                        button: 'CLOSE'
                    }
                    this.$snack['danger'](config);
                    console.log(err);
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

<style>
    .owl-carousel .products .product {
        border: 1px solid #ddd;
        padding: 8px;
        border-radius: 4px;
        margin-bottom: 12px;
        transition: all ease-in-out 0.3s;
    }
    .ribbon2 {
        color: #fd9c2e;
        filter: drop-shadow(2px 3px 2px rgba(0,0,0,.5));
        position: absolute;
        right: -95px;
        top: -3px;
    }
    .starBadge {
        -webkit-backdrop-filter: blur(4px);
        backdrop-filter: blur(4px);
        background: hsla(0,0%,100%,.2);
        border: 1px solid hsla(0,0%,100%,.2);
        margin-bottom: 1rem;
        margin-right: 1rem;
        position: absolute;
        width: 128px;
        z-index: 9999;
    }
    .owl-carousel .ribbon2 {
        right: auto;
    }
</style>