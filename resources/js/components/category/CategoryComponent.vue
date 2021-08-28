<template>
  <div class="row">
    <div class="col">
      <div class="page-heading">
        <h3>Category List</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-title text-end p-4">
                <button class="btn btn-primary" @click="editMode=false; openModal()">Add New Category</button>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-lg">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="category in product_categories" :key="category.id">
                        <td class="text-bold-500">{{ category.name }}</td>
                        <td>
                          <img v-if="category.image" :src="`/storage/images/${category.image}`" height="50" width="50"/>
                          <h6 v-else>No Image</h6>
                        </td>
                        <td class="text-bold-500">
                          <button class="btn btn-warning btn-sm pt-2" type="button"
                                  @click="editCategoryModal(category.id)">
                            <i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger btn-sm pt-2 ms-1" type="button"
                                  @click="deleteCategory(category.id)"><i
                              class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                  <div v-if="product_categories.length ==0 " class="no-product text-center mt-2">
                    <h2>No Product Category Found</h2>
                  </div>
                  <div class="mt-5">
                    <pagination align="center" :data="pagination" @pagination-change-page="getProductCategories">
                      <span slot="prev-nav">&lt; Previous</span>
                      <span slot="next-nav">Next &gt;</span>
                    </pagination>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <div id="createCategoryModal" aria-labelledby="createCategoryModal" aria-modal="true"
             class="modal fade text-left show" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <form multiple="form/data" @submit.prevent="editMode ? updateCategory(category.id) : storeCategory()">
                <div class="modal-header bg-primary">
                  <h5 class="modal-title white">
                    {{ editMode ? "Edit" : "Add" }}
                    Category
                  </h5>
                  <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                    <i data-feather="x"></i>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input v-model="category.name" class="form-control" placeholder="Category Name" required
                           type="text">
                  </div>

                  <div class="form-group">
                    <label>Image</label>
                    <ImageUpload ref="ImageUpload" :max="1" @change="handleImages"></ImageUpload>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-light-secondary" data-bs-dismiss="modal" type="button" @click="closeModal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                  </button>
                  <button v-if="editMode" class="btn btn-success ml-1" type="submit">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Update</span>
                  </button>
                  <button v-else class="btn btn-primary ml-1" type="submit">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Create</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div id="categoryDeleteConfirmationModal" class="modal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Delete Category</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"
                        @click="closeConfirmModal"></button>
              </div>
              <div class="modal-body">
                <p>Are you sure want to delete this category?</p>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button" @click="closeConfirmModal">
                  Cancel
                </button>
                <button class="btn btn-primary" type="button" @click="deleteCategory">Yes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ImageUpload from "../image-upload-component/ImageUpload";

export default {
  components: {
    ImageUpload,
  },

  data() {
    return {
      editMode          : false,
      category          : {
        id   : '',
        name : '',
        image: ''
      },
      product_categories: [],
      deleteCategoryId  : '',
      pagination        : {}
    }
  },

  mounted() {
    this.getProductCategories();
  },

  methods: {

    handleImages(files) {
      this.category.image = files[0];
    },
    openModal() {
      if (!this.editMode) {
        this.editMode               = false;
        this.category               = {};
        this.$refs.ImageUpload.Imgs = [];
        this.$refs.ImageUpload.files = [];
      }
      document.querySelector("#createCategoryModal").style.display    = 'block';
      document.querySelector("#createCategoryModal").style.background = 'rgba(0,0,0,.5)';
    },

    closeModal() {
      document.querySelector("#createCategoryModal").style.display = 'none';
    },

    editCategoryModal(categoryId) {
      axios.get(`/admin/category/${categoryId}`)
          .then((response) => {
            if (response.data.image != null) {
              this.$refs.ImageUpload.Imgs = [];
              this.$refs.ImageUpload.Imgs.push(`/storage/images/${response.data.image}`)
            }
            this.category.id   = response.data.id;
            this.category.name = response.data.name;
            this.editMode      = true;
            this.openModal();
          })
          .catch(() => {

          })
          .finally(() => {

          })
    },

    updateCategory(id) {
      let file = new FormData();
      file.append('image', this.category.image);
      file.append('name', this.category.name);
      const config = {
        headers: {"content-type": "multipart/form-data"}
      }
      axios.post(`/admin/category/${id}`, file, config)
          .then(() => {
            this.$toast.open({
              message: 'Successfully Category Updated.',
              type   : 'info',
            });
            document.querySelector("#createCategoryModal").style.display = 'none';
            this.category                                                = {
              id   : '',
              name : '',
              image: ''
            };
            this.getProductCategories();
          })
          .catch(() => {

          })
          .finally(() => {

          })
    },

    getProductCategories(page = 1) {
      axios.get('/admin/category/list?page=' + page)
          .then((response) => {
            this.pagination         = response.data;
            this.product_categories = response.data.data;

          })
          .catch(() => {

          })
          .finally(() => {

          })
    },

    storeCategory() {
      let file = new FormData();
      file.append('image', this.category.image);
      file.append('name', this.category.name);
      const config = {
        headers: {"content-type": "multipart/form-data"}
      }
      axios.post('/admin/category/store', file, config)
          .then(() => {
            this.$toast.open({
              message: 'Successfully Category Created.',
              type   : 'info',
            });
            document.querySelector("#createCategoryModal").style.display = 'none';
            this.category                                                = {};
            this.$refs.ImageUpload.Imgs = [];
            this.getProductCategories();
          })
          .catch(() => {

          })
          .finally(() => {

          })
    },

    openConfirmModal(id) {
      this.deleteCategoryId                                                       = id;
      document.querySelector("#categoryDeleteConfirmationModal").style.display    = 'block';
      document.querySelector("#categoryDeleteConfirmationModal").style.background = 'rgba(0,0,0,.5)';
    },

    closeConfirmModal() {
      document.querySelector("#categoryDeleteConfirmationModal").style.display = 'none';
    },

    deleteCategory(id) {

      this.$swal.fire({
        title             : 'Are you sure?',
        text              : "You won't delete this category !",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/admin/category/${id}`)
              .then((response) => {
                this.getProductCategories();
              })
          this.$swal.fire(
              'Deleted!',
              'Successfully Category Deleted.',
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