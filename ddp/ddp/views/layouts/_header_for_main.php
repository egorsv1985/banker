       <!-- ========================= SECTION MAIN ========================= -->
       <section class="section-main bg padding-y-sm">
         <div class="container">
           <div class="card p-0">
             <div class="card-body p-0">
               <div class="row row-sm">
                 <div class="col-md-12">
                   <!-- ================= main slide ================= -->
                   <!-- Iview Slider -->
                   <div class="slider">
                       <? // Блок слайдера баннеров на главной ?>
                       <? $this->widget('application.components.widgets.sliderBlock') ?>
                   </div>
                   <?/*
                   <div class="owl-init slider-main owl-carousel" data-items="1" data-nav="true" data-dots="false">
                     <div class="item-slide">
                       <img src="images/banners/slide1.jpg">
                     </div>
                     <div class="item-slide">
                       <img src="images/banners/slide2.jpg">
                     </div>
                     <div class="item-slide">
                       <img src="images/banners/slide3.jpg">
                     </div>
                   </div> */?>
                   <!-- ============== main slidesow .end // ============= -->
                 </div> <!-- col.// -->
               </div> <!-- row.// -->
             </div> <!-- card-body .// -->
           </div> <!-- card.// -->

           <figure class="mt-3 banner p-3 bg-secondary">
             <div class="text-lg text-center white">Useful banner can be here</div>
           </figure>

         </div> <!-- container .//  -->
       </section>
       <!-- ========================= SECTION MAIN END// ========================= -->