<template>
  <div class="row">
    <div class="page-heading">
      <h3>Message List</h3>
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
                  <tr v-for="(contact,idx) in contacts" :key="contacts.id">
                    <td class="text-bold-500 text-capitalize">{{ contact.name ? contact.name :  "--" }}</td>
                    <td class="text-bold-500">{{ contact.email ? contact.email : "--" }}</td>
                    <td class="text-bold-500">{{ contact.phone ? contact.phone :  "--" }}</td>
                    <td class="text-bold-500">{{ contact.order_no ? contact.order_no : "--" }}</td>
                    <td class="text-bold-500">{{ contact.message ? contact.message : "--" }}</td>
                    <td class="text-bold-500">
                      <span v-if="contact.read == 1" class="badge rounded-pill py-2 px-4 bg-success">Read</span>
                      <span v-else class="badge rounded-pill py-2 px-3 bg-danger">Unread</span>
                    </td>

                    <td  @click="activeMessage=contact" class="text-bold-500">
                      <button class="btn btn-warning btn-sm pt-2" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-eye-fill"></i></button>
                    </td>

                  </tr>
                  </tbody>
                </table>
              </div>
              <div class="mt-5">
                              <pagination align="center" :data="pagination" @pagination-change-page="getContacts">
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-md">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title  text-white" id="exampleModalLabel">Message Info</h5>
            <button type="button" class="btn-close  text-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label class="mb-3 text-capitalize"><span class="fw-bold">Name :</span> {{ activeMessage.name }}</label><br>
            <label class="mb-3"><span class="fw-bold">Email :</span> {{ activeMessage.email }}</label><br>
            <label class="mb-3"><span class="fw-bold">Phone :</span> {{ activeMessage.phone }}</label><br>
            <label class="mb-3"><span class="fw-bold">Order Number :</span> {{ activeMessage.order_no ? activeMessage.order_no : "--" }}</label><br>
            <label class="mb-2"><span class="fw-bold">Message</span></label>
            <textarea readonly class="w-100 rounded p-2">{{ activeMessage.message }}</textarea>


          </div>
          <div class="modal-footer">
            <button v-if="activeMessage.read == 0"  @click="changeRead(activeMessage.id)" type="button" data-bs-dismiss="modal" class="btn btn-success">Make as Read</button>
            <button v-else @click="changeRead(activeMessage.id)" type="button" data-bs-dismiss="modal" class="btn btn-danger">Make as Unread</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContactComponent",
  data() {
    return {
      activeMessage : {},
      pagination: {},
      contacts  : []
    }
  },
  mounted() {
    this.getContacts();
  },
  methods: {
    getContacts(page = 1) {
      axios.get('/admin/contact/list?page=' + page)
          .then((response) => {
            this.pagination         = response.data;
            this.contacts = response.data.data;
          })


    },
    changeRead(id){
      axios.post('/admin/contact/change-read',{id})
          .then((response) => {
           this.getContacts();
          })
    }
  }
}
</script>

<style scoped>

</style>