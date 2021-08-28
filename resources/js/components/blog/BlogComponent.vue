<template>
  <div class="row">
    <div class="col">
      <div class="page-heading">
        <h3>Blog List</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-title text-end p-4">
                <button class="btn btn-primary" @click="reset()" data-bs-target="#exampleModal" data-bs-toggle="modal">Add New Blog
                </button>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-lg">
                      <thead>
                      <tr>
                        <th>Title</th>
                        <th>Image</th>
<!--                        <th>Description</th>-->
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="blog in blogs" :key="blog.id">
                        <td class="text-bold-500">{{ blog.title }}</td>
                        <td>
                          <img v-if="blog.image" :src="`/storage/images/${blog.image}`" height="50" width="50"/>
                          <h6 v-else>No Image</h6>
                        </td>
<!--                        <td class="text-bold-500" v-html="blog.description"></td>-->
                        <td class="text-bold-500 text-nowrap">
                          <button class="btn btn-warning btn-sm pt-2" data-bs-target="#viewModal"
                                  data-bs-toggle="modal"
                                  type="button"
                                  @click="viewBlog(blog)">
                            <i class="bi bi-eye"></i></button>
                          <button class="btn btn-success btn-sm pt-2 mx-1" data-bs-target="#exampleModal"
                                  data-bs-toggle="modal"
                                  type="button"
                                  @click="editBlog(blog)">
                            <i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger btn-sm pt-2" type="button"
                                  @click="deleteBlog(blog.id)"><i
                              class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                  <div v-if="blogs.length ==0 " class="no-product text-center mt-2">
                    <h2>No Blog Found</h2>
                  </div>
                  <div class="mt-5">
                    <pagination :data="pagination" align="center" @pagination-change-page="getBlogs">
                      <span slot="prev-nav">&lt; Previous</span>
                      <span slot="next-nav">Next &gt;</span>
                    </pagination>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


        <!--edit Modal -->
        <div id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form multiple="form/data" @submit.prevent="editMode ? updateBlog() : storeBlog()">
                <div class="modal-header bg-primary">
                  <h5 id="exampleModalLabel" class="modal-title text-white">{{ editMode ? "Edit" : "Add New" }}
                    Blog</h5>
                  <button id="modal-close" aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                          type="button"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Blog Title</label>
                    <input v-model="blog.title" class="form-control" placeholder="Type here..." required
                           type="text">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <vue-editor v-model="blog.description"></vue-editor>
                  </div>

                  <div class="form-group">
                    <label>Image</label>
                    <ImageUpload ref="ImageUpload" :max="1" @change="handleImages"></ImageUpload>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
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
        </div><!-- Modal -->


<!--       view modal-->
        <div id="viewModal" aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h5 id="viewModalLabel" class="modal-title text-white">View Blog</h5>
                  <button id="view-modal-close" aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                          type="button"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="text-capitalize fw-bold">Blog Title : {{ blog.title }}</label>
                  </div>

                  <div class="form-group">
                    <label class="fw-bold">Description :</label>
                    <div class="border p-2" v-html="blog.description"></div>
                  </div>
                  <div class="form-group">
                    <label class="fw-bold">Image :</label><br>
                    <img v-if="blog.image" :src="`/storage/images/${blog.image}`" width="100%"/>
                    <h6 v-else>No Image</h6>
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
    </div>

  </div>
</template>

<script>
import ImageUpload from "../image-upload-component/ImageUpload";

export default {
  name      : "BlogComponent",
  components: {ImageUpload},
  data() {
    return {
      editMode  : false,
      blog      : {
        title      : "",
        image      : "",
        description: ""
      },
      pagination: {},
      blogs     : [],
    }
  },
  mounted() {
    this.getBlogs();
  },
  methods: {
    handleImages(files) {
      console.log(files)
      this.blog.image = files[0];
    },
    getBlogs(page = 1) {
      axios.get('/admin/blog/list?page=' + page)
          .then((response) => {
            this.pagination = response.data;
            this.blogs      = response.data.data;
          })
    },
    viewBlog(viewBlog){
      this.blog = viewBlog;
    },
    storeBlog() {
      let file = new FormData();
      file.append('image', this.blog.image);
      file.append('title', this.blog.title);
      file.append('description', this.blog.description);
      const config = {
        headers: {"content-type": "multipart/form-data"}
      }
      axios.post('/admin/blog/store', file, config)
          .then(() => {
            this.reset();
            this.getBlogs();
            document.getElementById('modal-close').click();
            this.$toast.open({
              message: 'Successfully Blog Created.',
              type   : 'info',
            });
          })
          .catch(() => {

          })
          .finally(() => {

          })

    },
    updateBlog() {
      let file = new FormData();
      file.append('id', this.blog.id);
      file.append('image', this.blog.image);
      file.append('title', this.blog.title);
      file.append('description', this.blog.description);
      const config = {
        headers: {"content-type": "multipart/form-data"}
      }
      axios.post(`/admin/blog/update`, file, config)
          .then(() => {
            this.reset();
            this.getBlogs(this.pagination.current_page);
            document.getElementById('modal-close').click();
            this.$toast.open({
              message: 'Successfully Blog Updated.',
              type   : 'info',
            });
          })
          .catch(() => {

          })
          .finally(() => {

          })
    },
    editBlog(blog) {
      let editBlog                = {
        id         : blog.id,
        title      : blog.title,
        image      : blog.image,
        description: blog.description
      }
      this.blog                   = editBlog;
      this.editMode               = true;
      this.$refs.ImageUpload.Imgs = [];
      this.$refs.ImageUpload.Imgs.push(`/storage/images/${blog.image}`)
    },
    deleteBlog(id) {
      this.$swal.fire({
        title             : 'Are you sure?',
        text              : "You won't delete this Blog !",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#435ebe',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/admin/blog/delete/${id}`)
              .then((response) => {
                this.reset();
                this.getBlogs(this.pagination.current_page);
              })
          this.$swal.fire(
              'Deleted!',
              'Successfully Blog Deleted.',
              'success'
          )
        }
      })
    },
    reset() {
      this.blog = {
        title      : "",
        image      : "",
        description: ""
      }
      this.$refs.ImageUpload.Imgs = [];
      this.$refs.ImageUpload.files = [];
      this.editMode = false;
    }
  }
}
</script>

<style scoped>

</style>