<template>
  <div class="row">
    <div class="col">
      <div class="page-heading">
        <h3>Order List</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-lg">
                      <thead>
                      <tr>
                        <th>Order No</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Total Amount</th>
                        <th>Shipping Method</th>
                        <th>Contact No</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="order in orders" :key="order.id">
                        <td class="text-bold-500">{{ order.order_uid }}</td>
                        <td class="text-bold-500">{{ moment(order.order_date).format('DD MMMM, YYYY') }}</td>
                        <td class="text-bold-500"><span class="badge rounded-pill bg-primary px-3 py-2">{{
                            order.status
                          }}</span></td>
                        <td class="text-bold-500">{{ order.ship_first_name + ' ' + order.ship_last_name }}</td>

                        <td class="text-bold-500">$ {{ order.total }}</td>
                        <td class="text-bold-500 text-capitalize">{{ order.shipping_method?order.shipping_method.replaceAll('_', ' '): 'N/A' }}</td>

                        <td class="text-bold-500">{{ order.ship_phone }}</td>
                        <td class="text-bold-500">
                          <button class="btn btn-warning btn-sm pt-2" data-bs-target="#viewModal"
                                  data-bs-toggle="modal"
                                  type="button"
                                  @click="activeOrder = order">
                            <i class="bi bi-eye"></i></button>
                          <button class="btn btn-success btn-sm pt-2 mx-1" data-bs-target="#editModal"
                                  data-bs-toggle="modal"
                                  type="button"
                                  @click="editOrder=order">
                            <i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger btn-sm pt-2" type="button" @click="deleteOrder(order.id)"><i
                              class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                  <div v-if="orders.length ==0 " class="no-product text-center mt-2">
                    <h2>No Order Found</h2>
                  </div>
                  <div class="d-flex justify-content-center mt-5">
                    <pagination :data="pagination" size="small" @pagination-change-page="getOrders">
                      <span slot="prev-nav">&lt; Previous</span>
                      <span slot="next-nav">Next &gt;</span>
                    </pagination>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!--       view modal-->
        <ViewOrderComponent></ViewOrderComponent>
        <!--        edit order modal-->
        <EditOrderComponent></EditOrderComponent>
      </div>
    </div>
  </div>
</template>

<script>

import ViewOrderComponent from "./ViewOrderComponent";
import EditOrderComponent from "./EditOrderComponent";

export default {
  components: {EditOrderComponent, ViewOrderComponent},
  data() {
    return {
      activeOrder: {},
      editOrder  : {},
      orders     : [],
      pagination : {},
      subTotal   : 0
    }
  },
  mounted() {
    this.getOrders();

  },
  methods: {
    getOrders(page = 1) {
      axios.get('/api/v1/admin/orders?page=' + page)
          .then((response) => {
            this.pagination = response.data;
            this.orders     = response.data.data;
          }, (err) => {
            console.log(err.response);
          })
    },
    deleteOrder(id) {
      this.$swal.fire({
        title             : 'Are you sure?',
        text              : "You won't delete this Order !",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/admin/order/${id}`)
              .then((response) => {
                this.$toast.open({
                  message: 'Successfully Order Updated.',
                  type   : 'success',
                });
                this.getOrders(this.pagination.current_page);
              })
              .catch(() => {

              })
              .finally(() => {

              })
          this.$swal.fire(
              'Deleted!',
              'Successfully Order Deleted.',
              'success'
          )
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
