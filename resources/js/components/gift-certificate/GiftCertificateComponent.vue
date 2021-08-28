<template>
  <div class="row">
    <div class="page-heading">
      <h3>Gift Certificates</h3>
    </div>
    <section class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-lg">
                  <thead>
                  <tr>
                    <th>Recipient Name</th>
                    <th>Recipient Email</th>
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Amount</th>
                    <th>Gift Card Code</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(giftCertificate,idx) in giftCertificates" :key="giftCertificate.id">
                    <td class="text-bold-500 text-capitalize">
                      {{ giftCertificate.recipient_name ? giftCertificate.recipient_name : "--" }}
                    </td>
                    <td class="text-bold-500">
                      {{ giftCertificate.recipient_email ? giftCertificate.recipient_email : "--" }}
                    </td>
                    <td class="text-bold-500">{{
                        giftCertificate.client_name ? giftCertificate.client_name : "--"
                      }}
                    </td>
                    <td class="text-bold-500">{{
                        giftCertificate.client_email ? giftCertificate.client_email : "--"
                      }}
                    </td>
                    <td class="text-bold-500">{{ giftCertificate.amount ? giftCertificate.amount : "--" }}</td>
                    <td class="text-bold-500">{{
                        giftCertificate.gift_card_code ? giftCertificate.gift_card_code : "--"
                      }}
                    </td>

                    <td class="text-bold-500">
                      <span v-if="giftCertificate.is_active == 1"
                            class="badge rounded-pill py-2 px-4 bg-success">Active</span>
                      <span v-else class="badge rounded-pill py-2 px-3 bg-danger">Deactivated</span>
                    </td>
                    <td class="text-bold-500">
                      <span v-if="giftCertificate.is_payment_completed == 1"
                            class="badge rounded-pill py-2 px-4 bg-success">Completed</span>
                      <span v-else class="badge rounded-pill py-2 px-3 bg-danger">Incompleted</span>
                    </td>

                    <td class="text-bold-500 text-nowrap" @click="activeGiftCertificate=giftCertificate">
                      <button class="btn btn-warning btn-sm pt-2" data-bs-target="#giftCertificateModal"
                              data-bs-toggle="modal"
                              type="button">
                        <i class="bi bi-eye-fill"></i></button>
                      <button class="btn btn-success btn-sm pt-2 mx-1" data-bs-target="#editGiftCertificateModal"
                              data-bs-toggle="modal"
                              type="button"
                              @click="editGiftCertificateFunction(giftCertificate)">
                        <i class="bi bi-pencil"></i></button>
                      <button class="btn btn-danger btn-sm pt-2" type="button"
                              @click="deleteGiftCertificate(giftCertificate.id)"><i
                          class="bi bi-trash"></i></button>
                    </td>

                  </tr>
                  </tbody>
                </table>
              </div>
              <div v-if="giftCertificates.length == 0 " class="no-product text-center mt-2">
                <h2>No Gift Certificates Found</h2>
              </div>
              <div class="mt-5">
                <pagination :data="pagination" align="center" @pagination-change-page="getGiftCertificates">
                  <span slot="prev-nav">&lt; Previous</span>
                  <span slot="next-nav">Next &gt;</span>
                </pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--View Modal -->
    <div id="giftCertificateModal" aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade"
         tabindex="-1">
      <div class="modal-dialog  modal-md">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 id="exampleModalLabel" class="modal-title  text-white">Gift Certificates</h5>
            <button aria-label="Close" class="btn-close  text-white" data-bs-dismiss="modal" type="button"></button>
          </div>
          <div class="modal-body">
            <label class="mb-3 text-capitalize"><span class="fw-bold">Recipient Name :</span>
              {{ activeGiftCertificate.recipient_name ? activeGiftCertificate.recipient_name : '--' }}</label><br>
            <label class="mb-3"><span class="fw-bold">Recipient Email :</span>
              {{ activeGiftCertificate.recipient_email ? activeGiftCertificate.recipient_email : '--' }}</label><br>
            <label class="mb-3"><span class="fw-bold">Client Name :</span>
              {{ activeGiftCertificate.client_name ? activeGiftCertificate.client_name : '--' }}</label><br>
            <label class="mb-3"><span class="fw-bold">Client Email :</span>
              {{ activeGiftCertificate.client_email ? activeGiftCertificate.client_email : '--' }}</label><br>
            <label class="mb-2"><span
                class="fw-bold">Amount : </span>{{ activeGiftCertificate.amount ? activeGiftCertificate.amount : '--' }}</label><br>
            <label class="mb-2"><span
                class="fw-bold">Gift Card Code : </span>{{
                activeGiftCertificate.gift_card_code ? activeGiftCertificate.gift_card_code : '--'
              }}</label><br>
            <label class="mb-2"><span class="fw-bold">Status :</span>
              {{ activeGiftCertificate.is_active == 1 ? 'Active' : 'Deactivated' }}</label><br>
            <label class="mb-2"><span class="fw-bold">Payment Status : </span>
              {{ activeGiftCertificate.is_payment_completed == 1 ? 'Completed' : 'Incompleted' }}</label><br>
            <label class="mb-2"><span class="fw-bold">Message</span></label>
            <textarea class="w-100 rounded border-0" readonly>{{ activeGiftCertificate.message }}</textarea>


          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Edit  Modal -->
    <div id="editGiftCertificateModal" aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade"
         tabindex="-1">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 id="examplModalLabel" class="modal-title  text-white">Edit Gift Certificates</h5>
            <button id="modal-close" aria-label="Close" class="btn-close  text-white" data-bs-dismiss="modal"
                    type="button"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label" for="recipient_name">Recipient Name</label>
              <input id="recipient_name" v-model="editGiftCertificate.recipient_name" class="form-control"
                     placeholder="Recipient Name"
                     type="text">
            </div>
            <div class="mb-3">
              <label class="form-label" for="recipient_email">Recipient Email</label>
              <input id="recipient_email" v-model="editGiftCertificate.recipient_email" class="form-control"
                     placeholder="Recipient Email" type="email">
            </div>
            <div class="mb-3">
              <label class="form-label" for="client_name">Client Name</label>
              <input id="client_name" v-model="editGiftCertificate.client_name" class="form-control"
                     placeholder="Client Name"
                     type="text">
            </div>
            <div class="mb-3">
              <label class="form-label" for="client_email">Client Email</label>
              <input id="client_email" v-model="editGiftCertificate.client_email" class="form-control"
                     placeholder="Client Email"
                     type="email">
            </div>
            <div class="mb-3">
              <label class="form-label" for="amount">Amount</label>
              <input id="amount" v-model="editGiftCertificate.amount" class="form-control" placeholder="Amount"
                     type="number">
            </div>
            <div class="mb-3">
              <label class="form-label" for="gift_card_code">Gift Card Code</label>
              <input id="gift_card_code" v-model="editGiftCertificate.gift_card_code" class="form-control"
                     placeholder="Gift Card Code"
                     type="text">
            </div>
            <div class="mb-3">
              <label class="form-label">Status</label>
              <div class="form-check">
                <input id="flexRadioDefault1" v-model="editGiftCertificate.is_active" class="form-check-input"
                       name="is_active"
                       type="radio" value="1">
                <label class="form-check-label" for="flexRadioDefault1">
                  Active
                </label>
              </div>
              <div class="form-check">
                <input id="flexRadioDefault2" v-model="editGiftCertificate.is_active" class="form-check-input"
                       name="is_active"
                       type="radio" value="0">
                <label class="form-check-label" for="flexRadioDefault2">
                  Dectivated
                </label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Payment Status</label>
              <div class="form-check">
                <input id="flexRadioDefault3" v-model="editGiftCertificate.is_payment_completed"
                       class="form-check-input"
                       name="payment" type="radio" value="1">
                <label class="form-check-label" for="flexRadioDefault3">
                  Completed
                </label>
              </div>
              <div class="form-check">
                <input id="flexRadioDefault4" v-model="editGiftCertificate.is_payment_completed"
                       class="form-check-input"
                       name="payment" type="radio" value="0">
                <label class="form-check-label" for="flexRadioDefault4">
                  Incompleted
                </label>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label" for="exampleFormControlTextarea1">Message</label>
              <textarea id="exampleFormControlTextarea1" v-model="editGiftCertificate.message" class="form-control"
                        rows="3"></textarea>
            </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
            <button class="btn btn-success ml-1" type="button" @click="updateGiftCertificate()">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Update</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "GiftCertificateComponent",
  data() {
    return {
      activeGiftCertificate: {},
      editGiftCertificate  : {},
      pagination           : {},
      giftCertificates     : []
    }
  },
  mounted() {
    this.getGiftCertificates();
  },
  methods: {
    getGiftCertificates(page = 1) {
      axios.get('/admin/gift-certificate/list?page=' + page)
          .then((response) => {
            this.pagination       = response.data;
            this.giftCertificates = response.data.data;
          })


    },
    editGiftCertificateFunction(giftCertificate) {

      let giftCard = {
        id                  : giftCertificate.id,
        user_id             : giftCertificate.user_id,
        recipient_name      : giftCertificate.recipient_name,
        recipient_email     : giftCertificate.recipient_email,
        client_name         : giftCertificate.client_name,
        client_email        : giftCertificate.client_email,
        amount              : giftCertificate.amount,
        gift_card_code      : giftCertificate.gift_card_code,
        is_active           : giftCertificate.is_active,
        is_payment_completed: giftCertificate.is_payment_completed,
        message             : giftCertificate.message,
      }

      this.editGiftCertificate = giftCard;

    },
    updateGiftCertificate() {
      axios.put(`/admin/gift-certificate/update/${this.editGiftCertificate.id}`, this.editGiftCertificate)
          .then(() => {
            this.getGiftCertificates(this.pagination.current_page);
            document.getElementById('modal-close').click();
            this.$toast.open({
              message: 'Successfully Gift Certificate Updated.',
              type   : 'info',
            });
          })
          .catch(() => {

          })
          .finally(() => {

          })
    },
    deleteGiftCertificate(id) {
      this.$swal.fire({
        title             : 'Are you sure?',
        text              : "You won't delete this Gift Certificate !",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#435ebe',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/admin/gift-certificate/delete/${id}`)
              .then((response) => {
                this.getGiftCertificates(this.pagination.current_page);
              })
          this.$swal.fire(
              'Deleted!',
              'Successfully Gift Certificate Deleted.',
              'success'
          )
        }
      })
    }
  }
}
</script>

<style scoped>

</style>