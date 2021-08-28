<template>
  <div class="row">
    <div class="col">
      <div class="page-heading">
        <h3>Product List</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-title text-end p-4">
                <a href="/admin/product/create">
                  <button class="btn btn-primary">Add New Product</button>
                </a>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-lg">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Unit</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="product in products" :key="product.id">
                        <td class="text-bold-500">{{ product.name }}</td>
                        <td>
                          <img v-for="image in product.images"
                               :src="`/storage/images/${image.image}`" class="rounded mx-1 border" height="50"
                               width="50"/>
                          <h6 v-if="product.images.length == 0">No Image</h6>
                        </td>
                        <td class="text-bold-500">{{ product.price }}</td>
                        <td class="text-bold-500">{{ product.unit_value ? product.unit_value : "--" }} {{ product.unit_type ? product.unit_type : "--" }}</td>
                        <td class="text-bold-500">
                          <a :href="`/admin/product/edit/${product.id}`">
                            <button class="btn btn-warning btn-sm me-1 pt-2" type="button"><i class="bi bi-pencil"></i>
                            </button>
                          </a>
                          <!--                                                        <button type="button" class="btn btn-secondary btn-sm"><i class="bi bi-eye"></i></button>-->
                          <button class="btn btn-danger btn-sm pt-2" type="button" @click="deleteProduct(product.id)"><i
                              class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                  <div v-if="products.length ==0 " class="no-product text-center mt-2">
                    <h2>No Product Found</h2>
                  </div>
                  <div class="d-flex justify-content-center mt-5">
                    <pagination :data="pagination" size="small" @pagination-change-page="getProducts">
                      <span slot="prev-nav">&lt; Previous</span>
                      <span slot="next-nav">Next &gt;</span>
                    </pagination>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},

  data() {
    return {
      products  : [],
      pagination: {}
    }
  },

  mounted() {
    this.getProducts();
  },

  methods: {
    getProducts(page = 1) {
      axios.get('/admin/product/list?page=' + page)
          .then((response) => {
            this.pagination = response.data
            this.products   = response.data.data;
          })
          .catch(() => {

          })
          .finally(() => {

          })
    },

    openConfirmModal(id) {
      this.deleteProductId                                                       = id;
      document.querySelector("#productDeleteConfirmationModal").style.display    = 'block';
      document.querySelector("#productDeleteConfirmationModal").style.background = 'rgba(0,0,0,.5)';
    },

    closeConfirmModal() {
      document.querySelector("#productDeleteConfirmationModal").style.display = 'none';
    },

    deleteProduct(id) {
      this.$swal.fire({
        title             : 'Are you sure?',
        text              : "You won't delete this Product !",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/admin/product/${id}`)
              .then((response) => {
                this.getProducts();
              })
              .catch(() => {

              })
              .finally(() => {

              })
          this.$swal.fire(
              'Deleted!',
              'Successfully Product Deleted.',
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