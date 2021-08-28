<template>
  <div id="viewModal" aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 id="viewModalLabel" class="modal-title text-white">View Ordered Product</h5>
          <button id="view-modal-close" aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                  type="button"></button>
        </div>
        <div v-if="$parent.activeOrder" class="modal-body mx-3">
          <div class="row">
            <div class="form-group col-10">
              <label class="text-capitalize fw-bold">Order : {{ $parent.activeOrder.order_uid }} </label>
              <div class="btn btn-info ms-5"> {{ $parent.activeOrder.status }}</div>
            </div>
            <div  class="print-icon text-end my-auto col-2" role="button">
              <svg @click="printOrder()" fill="none" viewBox="0 0 20 20" width="15%" xmlns="http://www.w3.org/2000/svg" >
                <path
                    d="M6.09375 17.6562H13.9062C14.2299 17.6562 14.4922 17.394 14.4922 17.0703C14.4922 16.7467 14.2299 16.4844 13.9062 16.4844H6.09375C5.77011 16.4844 5.50781 16.7467 5.50781 17.0703C5.50781 17.394 5.77011 17.6562 6.09375 17.6562Z"
                    fill="#A5A5A5"/>
                <path
                    d="M6.09375 15.3125H13.9062C14.2299 15.3125 14.4922 15.0502 14.4922 14.7266C14.4922 14.4029 14.2299 14.1406 13.9062 14.1406H6.09375C5.77011 14.1406 5.50781 14.4029 5.50781 14.7266C5.50781 15.0502 5.77011 15.3125 6.09375 15.3125Z"
                    fill="#A5A5A5"/>
                <path
                    d="M18.6328 5.58594H16.7578V1.36719C16.7578 0.613251 16.1446 0 15.3906 0H4.60938C3.85544 0 3.24219 0.613251 3.24219 1.36719V5.58594H1.36719C0.613251 5.58594 0 6.19919 0 6.95312V15.3906C0 16.1446 0.613251 16.7578 1.36719 16.7578H3.24219V18.6328C3.24219 19.3867 3.85544 20 4.60938 20H15.3906C16.1446 20 16.7578 19.3867 16.7578 18.6328V16.7578H18.6328C19.3867 16.7578 20 16.1446 20 15.3906V6.95312C20 6.19919 19.3867 5.58594 18.6328 5.58594ZM4.41406 1.36719C4.41406 1.25946 4.50165 1.17188 4.60938 1.17188H15.3906C15.4984 1.17188 15.5859 1.25946 15.5859 1.36719V5.58594H4.41406V1.36719ZM15.5859 18.6328C15.5859 18.7405 15.4984 18.8281 15.3906 18.8281H4.60938C4.50165 18.8281 4.41406 18.7405 4.41406 18.6328V12.9688H15.5859V18.6328ZM18.8281 15.3906C18.8281 15.4984 18.7405 15.5859 18.6328 15.5859H16.7578V12.3828C16.7578 12.0592 16.4955 11.7969 16.1719 11.7969H3.82812C3.50449 11.7969 3.24219 12.0592 3.24219 12.3828V15.5859H1.36719C1.25946 15.5859 1.17188 15.4984 1.17188 15.3906V6.95312C1.17188 6.8454 1.25946 6.75781 1.36719 6.75781H18.6328C18.7405 6.75781 18.8281 6.8454 18.8281 6.95312V15.3906Z"
                    fill="#A5A5A5"/>
                <path
                    d="M17.4609 8.71094C17.4609 9.03458 17.1986 9.29688 16.875 9.29688C16.5514 9.29688 16.2891 9.03458 16.2891 8.71094C16.2891 8.3873 16.5514 8.125 16.875 8.125C17.1986 8.125 17.4609 8.3873 17.4609 8.71094Z"
                    fill="#A5A5A5"/>
              </svg>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-lg">
              <thead>
              <tr>
                <th>PRODUCTS</th>
                <th>CODE</th>
                <th>DATE</th>
                <th>PRICE</th>
                <th>QUANTITY</th>
                <th class="text-end">TOTAL</th>
              </tr>
              </thead>
              <tbody>
              <tr v-if="$parent.activeOrder.products.length > 0" v-for="product in $parent.activeOrder.products">
                <td class="text-bold-500">
                  <img v-for="image in product.product.images"
                       :src="`/storage/images/${image.image}`" class="rounded mx-1 border" height="50"
                       width="50"/>
                  <h6 v-if="product.product.images.length == 0">No Image</h6>
                  {{ product.product.name ? product.product.name : '--' }}
                </td>
                <td class="text-bold-500">{{ product.product.code ? product.product.code : '--' }}</td>
                <td class="text-bold-500">{{ $parent.activeOrder ? moment( $parent.activeOrder.order_date).format('DD MMMM, YYYY'): '--'}}
                </td>
                <td class="text-bold-500">$ {{ product ? product.unit_price : 0 }}</td>
                <td class="text-bold-500">{{ product ? product.quantity : 0 }}</td>
                <td class="text-bold-500 text-end">$ {{ product ? product.quantity * product.unit_price : 0 }}</td>
              </tr>
              <tr v-if="$parent.activeOrder.gift_certificates.length > 0" v-for="giftCertificate in $parent.activeOrder.gift_certificates">
                <td class="text-bold-500">
<!--                  <img v-for="image in product.product.images"-->
<!--                       :src="`/storage/images/${image.image}`" class="rounded mx-1 border" height="50"-->
<!--                       width="50"/>-->
<!--                  <h6 v-if="product.product.images.length == 0">No Image</h6>-->
                  Gift Certificate
                </td>
                <td class="text-bold-500">{{ giftCertificate.gift_certificate.gift_card_code ?  giftCertificate.gift_certificate.gift_card_code : '--' }}</td>
                <td class="text-bold-500">{{ $parent.activeOrder ? moment( $parent.activeOrder.order_date).format('DD MMMM, YYYY'): '--'}}
                </td>
                <td class="text-bold-500">$ {{ giftCertificate ? giftCertificate.unit_price : 0 }}</td>
                <td class="text-bold-500">{{ giftCertificate ? giftCertificate.quantity : 0 }}</td>
                <td class="text-bold-500 text-end">$ {{ giftCertificate ? giftCertificate.quantity * giftCertificate.unit_price : 0 }}</td>
              </tr>
              </tbody>
            </table>
            <div class="row w-100 fw-bolder">
              <div class="col-6"></div>
              <div class="col-6">
                <div class="row">
                  <div class="col-6">SUBTOTAL</div>
                  <div class="col-6 text-end">$ {{ parseFloat(($parent.activeOrder.total - ($parent.activeOrder.gst +
                    $parent.activeOrder.shipping_charge))- $parent.activeOrder.discount).toFixed(2) }}
                  </div>
                </div>
              </div>
            </div>
            <div class="row w-100 fw-bolder">
              <div class="col-6"></div>
              <div class="col-6">
                <div class="row">
                  <div class="col-6">SHIPPING</div>
                  <div class="col-6 text-end">$ {{ parseFloat($parent.activeOrder.shipping_charge).toFixed(2) }}</div>
                </div>
              </div>
            </div>
            <div class="row w-100 fw-bolder">
              <div class="col-6"></div>
              <div class="col-6">
                <div class="row">
                  <div class="col-6">CANADA GST</div>
                  <div class="col-6 text-end">$ {{ parseFloat($parent.activeOrder.gst).toFixed(2) }}</div>
                </div>
              </div>
            </div>
            <div class="row w-100 fw-bolder">
              <div class="col-6"></div>
              <div class="col-6">
                <div class="row">
                  <div class="col-6">DISCOUNT</div>
                  <div class="col-6 text-end">$ {{ parseFloat($parent.activeOrder.discount).toFixed(2) }}</div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <div class="row w-100 fw-bolder">
              <div class="col-6"></div>
              <div class="col-6">
                <div class="row">
                  <div class="col-6">TOTAL</div>
                  <div class="col-6 text-end text-primary"><h4>$ {{ parseFloat($parent.activeOrder.total).toFixed(2)
                    }}</h4></div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <div class="row w-100">
              <div class="col-8">
                <div class="row">
                  <div class="col-4">
                    <h6>SHIPPING ADDRESS</h6>
                    <p class="fw-bold">{{ $parent.activeOrder.ship_first_name +" "+ $parent.activeOrder.ship_last_name
                      }}<br>
                      {{ $parent.activeOrder.ship_phone ? $parent.activeOrder.ship_phone : " "}}<br>
                      {{ $parent.activeOrder.ship_address_line_1 ? $parent.activeOrder.ship_address_line_1 : " "}}<br>
                      {{ $parent.activeOrder.ship_address_line_2 ? $parent.activeOrder.ship_address_line_2 : " "}}<br>
                      {{ $parent.activeOrder.ship_city ? $parent.activeOrder.ship_city : " "}}<br>
                      {{ $parent.activeOrder.ship_postal_code ? $parent.activeOrder.ship_postal_code : " "}}<br>
                      {{ $parent.activeOrder.ship_country ? $parent.activeOrder.ship_country : " "}}<br>
                    </p>
                  </div>
                  <div class="col-4">
                    <h6>SHIPPING METHOD</h6>
                    <p class="fw-bold text-capitalize"> {{ $parent.activeOrder.shipping_method ?
                      $parent.activeOrder.shipping_method.replaceAll('_', ' ') : " "}}</p>
                  </div>
                  <div class="col-4">
                    <h6>SHIPPING DATE</h6>
                    <p class="fw-bold">{{ $parent.activeOrder.shipped_date ?
                      moment($parent.activeOrder.shipped_date).format('DD MMMM, YYYY') : "N/A"}}</p>
                  </div>
                </div>
              </div>
              <div class="col-4"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ViewComponent",
  methods : {
    printOrder(){
      window.print();
    }
  }

}
</script>

<style scoped>

</style>