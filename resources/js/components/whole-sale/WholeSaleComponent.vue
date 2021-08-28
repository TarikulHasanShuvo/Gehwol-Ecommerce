<template>
  <div class="row">
    <div class="page-heading">
      <h3>Wholesale List</h3>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Order Number</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(wholesale,idx) in wholesales" :key="wholesale.id">
                    <td class="text-bold-500 text-capitalize">{{ wholesale.name ? wholesale.name : "--" }}</td>
                    <td class="text-bold-500">{{ wholesale.email ? wholesale.email : "--" }}</td>
                    <td class="text-bold-500">{{ wholesale.phone ? wholesale.phone : "--" }}</td>
                    <td class="text-bold-500">{{ wholesale.order_no ? wholesale.order_no : "--" }}</td>
                    <td class="text-bold-500">{{ wholesale.message ? wholesale.message : "--" }}</td>
                    <td class="text-bold-500">
                      <span v-if="wholesale.read == 1" class="badge rounded-pill py-2 px-4 bg-success">Read</span>
                      <span v-else class="badge rounded-pill py-2 px-3 bg-danger">Unread</span>
                    </td>

                    <td class="text-bold-500" @click="activeMessage=wholesale">
                      <button class="btn btn-warning btn-sm pt-2" data-bs-target="#exampleModal" data-bs-toggle="modal"
                              type="button">
                        <i class="bi bi-eye-fill"></i></button>
                    </td>

                  </tr>
                  </tbody>
                </table>
              </div>
              <div v-if="wholesales.length == 0 " class="no-product text-center mt-2">
                <h2>No Wholesale Found</h2>
              </div>
              <div class="mt-5">
                <pagination :data="pagination" align="center" @pagination-change-page="getWholesales">
                  <span slot="prev-nav">&lt; Previous</span>
                  <span slot="next-nav">Next &gt;</span>
                </pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" tabindex="-1">
      <div class="modal-dialog  modal-md">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 id="exampleModalLabel" class="modal-title  text-white">Wholesale Info</h5>
            <button aria-label="Close" class="btn-close  text-white" data-bs-dismiss="modal" type="button"></button>
          </div>
          <div class="modal-body">
            <label class="mb-3 text-capitalize"><span class="fw-bold">Name :</span> {{ activeMessage.name }}</label><br>
            <label class="mb-3"><span class="fw-bold">Email :</span> {{ activeMessage.email }}</label><br>
            <label class="mb-3"><span class="fw-bold">Phone :</span> {{ activeMessage.phone }}</label><br>
            <label class="mb-3"><span class="fw-bold">Order Number :</span>
              {{ activeMessage.order_no ? activeMessage.order_no : "--" }}</label><br>
            <label class="mb-2"><span class="fw-bold">Message</span></label>
            <textarea class="w-100 rounded p-2" readonly>{{ activeMessage.message }}</textarea>


          </div>
          <div class="modal-footer">
            <button v-if="activeMessage.read == 0" class="btn btn-success" data-bs-dismiss="modal"
                    type="button" @click="changeRead(activeMessage.id)">Make as Read
            </button>
            <button v-else class="btn btn-danger" data-bs-dismiss="modal" type="button"
                    @click="changeRead(activeMessage.id)">Make as Unread
            </button>
            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "WholeSaleComponent",
  data() {
    return {
      activeMessage: {},
      pagination   : {},
      wholesales   : []
    }
  },
  mounted() {
    this.getWholesales();
  },
  methods: {
    getWholesales(page = 1) {
      axios.get('/admin/wholesale/list?page=' + page)
          .then((response) => {
            this.pagination = response.data;
            this.wholesales = response.data.data;
          })


    },
    changeRead(id) {
      axios.put('/admin/wholesale/change-read', {id})
          .then((response) => {
            this.getWholesales(this.pagination.current_page);
          })
    }
  }
}
</script>

<style scoped>

</style>