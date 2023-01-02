<template>
    <section id="best-seller" class="mt-2 section new-arriavls best-seller-main-block">
        <h3 class="section-title">{{ translate('BestSellers') }} </h3>

       <div>
           <best-sellers-slider v-if="bestseller" :bestseller="bestseller" :products="products" :date="date" :lang="lang" :fallbacklang="fallbacklang" :login="login" :guest_price="guest_price" :starbadge="true"></best-sellers-slider>

            <div v-else>
                <slider-skelton :item="6"></slider-skelton>
            </div>
       </div>
        
        <!-- /.home-owl-carousel -->
    </section>
</template>

<script>
    export default {
        props: ['products','date','lang','fallbacklang','login','guest_price','bestseller']

    }
</script>
