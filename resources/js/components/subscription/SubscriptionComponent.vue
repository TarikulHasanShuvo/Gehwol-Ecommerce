<template>
  <div class="row">
    <div class="page-heading">
      <h3>News Letter Subscriptions List</h3>
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
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(subscription,idx) in subscriptions" :key="subscription.id">
                    <td class="text-bold-500">{{ subscription.email ? subscription.email : "--" }}</td>
                    <td>
                      <span v-if="subscription.status == 1" class="badge rounded-pill py-2 px-4 bg-success">Send</span>
                      <span v-else class="badge rounded-pill py-2 px-3 bg-danger">UnSend</span>
                    </td>

                    <td class="text-bold-500" @click="editSubscriptions(subscription)">
                      <button class="btn btn-warning btn-sm pt-2" data-bs-target="#exampleModal" data-bs-toggle="modal"
                              type="button">
                        <i class="bi bi-pencil"></i></button>
                    </td>

                  </tr>
                  </tbody>
                </table>
              </div>
              <div v-if="subscriptions.length == 0 " class="no-product text-center mt-2">
                <h2>No Subscription Found</h2>
              </div>
              <div class="mt-5">
                <pagination :data="pagination" align="center" @pagination-change-page="getSubscriptions">
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
            <h5 id="exampleModalLabel" class="modal-title  text-white">Subscription Info</h5>
            <button aria-label="Close" class="btn-close  text-white" data-bs-dismiss="modal" type="button"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label" for="exampleInputEmail1">Email address</label>
              <input id="exampleInputEmail1" v-model="editSubscription.email" aria-describedby="emailHelp"
                     class="form-control"
                     type="email">
            </div>
            <div class="form-check">
              <input id="flexRadioDefault1" v-model="editSubscription.status" class="form-check-input"
                     name="news-letter"
                     type="radio" value="1">
              <label class="form-check-label" for="flexRadioDefault1">
                Send
              </label>
            </div>
            <div class="form-check">
              <input id="flexRadioDefault2" v-model="editSubscription.status" class="form-check-input"
                     name="news-letter"
                     type="radio" value="0">
              <label class="form-check-label" for="flexRadioDefault2">
                Unsend
              </label>
            </div>
          </div>
          <div class="modal-footer">
            <!--            <button v-if="editSubscription.status == 0" class="btn btn-success" data-bs-dismiss="modal"
                                type="button" @click="changeStatus(editSubscription.id)">Make as Send
                        </button>
                        <button v-else class="btn btn-danger" data-bs-dismiss="modal" type="button"
                                @click="changeStatus(editSubscription.id)">Make as Unsend
                        </button>-->
            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
            <button class="btn btn-primary" data-bs-dismiss="modal" type="button"
                    @click="updateSubscription()">Update
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SubscriptionComponent",
  data() {
    return {
      editSubscription: {},
      pagination      : {},
      subscriptions   : []
    }
  },
  mounted() {
    this.getSubscriptions();
  },
  methods: {
    getSubscriptions(page = 1) {
      axios.get('/admin/subscription/list?page=' + page)
          .then((response) => {
            this.pagination    = response.data;
            this.subscriptions = response.data.data;
          })
    },
    editSubscriptions(editData) {
      let data              = {
        id    : editData.id,
        email : editData.email,
        status: editData.status,
      }
      this.editSubscription = data;
    },
    updateSubscription() {
      axios.put('/admin/subscription/update', this.editSubscription)
          .then((response) => {
            this.getSubscriptions(this.pagination.current_page);
            this.$toast.open({
              message: 'Successfully subscription updated.',
              type   : 'success',
            });
          })
    }
  }
}
</script>

<style scoped>

</style>