<template>
  <div class="row">
    <div class="col">
      <div class="page-heading">
        <h3>Product Create</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <form multiple="form/data" @submit.prevent="storeProduct()">
                    <div class="row">
                      <div class="col-12 col-md-6">
                        <div class="form-group">
                          <label>Name</label>
                          <input v-model="product.name" class="form-control" placeholder="Product Name" required
                                 type="text">
                        </div>

                        <div class="form-group">
                          <label>Product UPC Code</label>
                          <input v-model="product.upcCode" class="form-control" placeholder="Product UPC Code"
                                 type="text">
                        </div>

                        <div class="form-group">
                          <label>Select Category</label>
                          <select v-model="product.category" aria-label="Default select example" class="form-select"
                                  required>
                            <option disabled selected value="">Select Category</option>
                            <option v-for="category in productCategories" :value="category.id">{{
                                category.name
                              }}
                            </option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label>Select Product Range</label>
                          <select v-model="product.range" aria-label="Default select example" class="form-select"
                                  required>
                            <option disabled selected value="">Select Product Range</option>
                            <option v-for="range in productRanges" :value="range.id">{{
                                range.name
                              }}
                            </option>
                          </select>
                        </div>


                        <div class="form-group">
                          <label>Select Brand</label>
                          <select v-model="product.brand" aria-label="Default select example" class="form-select"
                                  required>
                            <option disabled selected value="">Select Brand</option>
                            <option value="gehwol">Gehwol</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label>Image</label>
                          <ImageUpload ref="ImageUpload" :max="5" @change="handleImages"></ImageUpload>
                        </div>

                        <div class="form-group">
                          <label>Description</label>
                          <textarea v-model="product.description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                          <label>How to use</label>
                          <textarea v-model="product.howToUse" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                          <label>Who can use</label>
                          <textarea v-model="product.whoCanUse" class="form-control" rows="3"></textarea>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="form-group">
                          <label>Product Code</label>
                          <input v-model="product.code" class="form-control" placeholder="Product Code" required
                                 type="text">
                        </div>
                        <div class="form-group">
                          <label>UOM</label>
                          <select v-model="product.uom" aria-label="Default select example" class="form-select">
                            <option disabled selected value="">Select UOM</option>
                            <option value="Each">Each</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Select BL Category</label>
                          <select v-model="product.blCategory" aria-label="Default select example" class="form-select"
                                  required>
                            <option disabled selected value="">Select BL Category</option>
                            <option v-for="blCategory in productBlCategories" :value="blCategory.id">{{
                                blCategory.name
                              }}
                            </option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Select Product Type</label>
                          <select v-model="product.type" aria-label="Default select example" class="form-select"
                                  required>
                            <option disabled selected value="">Select Product Type</option>
                            <option v-for="type in productTypes" :value="type.id">{{
                                type.name
                              }}
                            </option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Select Number of Identical Products</label>
                          <select v-model="product.noOfIdenticalProducts" aria-label="Default select example"
                                  class="form-select"
                                  required>
                            <option disabled selected value="">Select Number of Identical Product</option>
                            <option v-for="num in 10" :value="num">{{
                                num
                              }}
                            </option>
                          </select>
                        </div>
                        <div class="form-group mb-3">
                          <label class="mb-2">New Product</label><br/>
                          <div class="form-check form-check-inline">
                            <input id="newProductYes" v-model="product.new" class="form-check-input" name="newProduct"
                                   type="radio"
                                   value="1">
                            <label class="form-check-label" for="newProductYes">Yes</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input id="newProductNo" v-model="product.new" class="form-check-input" name="newProduct"
                                   type="radio"
                                   value="0">
                            <label class="form-check-label" for="newProductNo">No</label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="mb-2">Professional Product</label><br/>
                          <div class="form-check form-check-inline">
                            <input id="professionalProductYes" v-model="product.professional" class="form-check-input"
                                   name="professionalProduct" type="radio" value="1">
                            <label class="form-check-label" for="professionalProductYes">Yes</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input id="professionalProductNo" v-model="product.professional" class="form-check-input"
                                   name="professionalProduct" type="radio" value="0">
                            <label class="form-check-label" for="professionalProductNo">No</label>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col">
                              <label>Original Price</label>
                              <input v-model="product.originalPrice" class="form-control"
                                     placeholder="Product Original Price" required
                                     type="number">
                            </div>
                            <div class="col">
                              <label>Price</label>
                              <input v-model="product.price" class="form-control" placeholder="Product Price" required
                                     type="number">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col">
                              <label>Unit Value</label>
                              <input v-model="product.unit_value" class="form-control" placeholder="Product Unit Value"
                                     required
                                     type="number">
                            </div>
                            <div class="col">
                              <label>Unit Type</label>
                              <select v-model="product.unit_type" aria-label="Default select example"
                                      class="form-select"
                                      required>
                                <option disabled selected value="">Select Unit Type</option>
                                <option value="litre">Litre</option>
                                <option value="ml">ML</option>
                                <option value="kg">Kg</option>
                                <option value="gm">Gm</option>
                                <option value="piece">Piece</option>
                                <option value="meter">Meter</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="productIngredient">Ingredient</label>
                          <textarea id="productIngredient" v-model="product.ingredient" class="form-control"
                                    rows="3"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="whatsItFor">What's it for</label>
                          <textarea id="whatsItFor" v-model="product.whatsItFor" class="form-control"
                                    rows="3"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex">
                        <div class="ms-auto">
                          <a class="btn btn-secondary" href="/admin/product" type="button">Cancel</a>
                          <button class="btn btn-success" type="submit">Create</button>
                        </div>
                      </div>
                    </div>
                  </form>
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
import VueDropify from 'vue-dropify';
import ImageUpload from "../image-upload-component/ImageUpload";

export default {
  components: {
    ImageUpload,
    VueDropify
  },

  data() {
    return {
      productCategories  : [],
      productBlCategories: [],
      productRanges      : [],
      productTypes       : [],
      product            : {
        name                 : '',
        code                 : '',
        brand                : '',
        description          : '',
        image                : [],
        category             : '',
        price                : '',
        originalPrice        : '',
        unit_value           : '',
        unit_type            : '',
        ingredient           : '',
        new                  : 1,
        professional         : 1,
        blCategory           : '',
        type                 : '',
        uom                  : '',
        upcCode              : '',
        range                : '',
        noOfIdenticalProducts: '',
        whatsItFor           : '',
        whoCanUse            : '',
        howToUse             : '',

      }
    }
  },

  mounted() {
    this.getProductRelatedData();
  },
  methods: {
    handleImages(files) {
      this.product.image = files
    },
    getProductRelatedData() {
      axios.get('/admin/product/related-data')
          .then((response) => {
            this.productCategories   = response.data.categories;
            this.productBlCategories = response.data.blCategories;
            this.productRanges       = response.data.ranges;
            this.productTypes        = response.data.types;
          })
          .catch(() => {

          })
          .finally(() => {

          })
    },

    fileAppend() {
      // let sku  = "sku-" + this.product.name.toLowerCase() + "-" + this.product.code + Math.floor(Math.random() * 10000) + "-" + this.product.category
      let file = new FormData();
      file.append('name', this.product.name);
     // file.append('sku', sku);
      file.append('code', this.product.code);
      file.append('brand', this.product.brand);
      file.append('description', this.product.description);
      file.append('product_category_id', this.product.category);
      file.append('price', this.product.price);
      file.append('original_price', this.product.originalPrice);
      file.append('unit_value', this.product.unit_value);
      file.append('unit_type', this.product.unit_type);
      file.append('ingredient', this.product.ingredient);
      file.append('new', this.product.new);
      file.append('product_bl_category_id', this.product.blCategory);
      file.append('product_type_id', this.product.type);
      file.append('product_range_id', this.product.range);
      file.append('upc_code', this.product.upcCode);
      file.append('uom', this.product.uom);
      file.append('no_of_identical_products', this.product.noOfIdenticalProducts);
      file.append('whats_it_for', this.product.whatsItFor);
      file.append('who_can_use', this.product.whoCanUse);
      file.append('how_to_use', this.product.howToUse);
      file.append('professional', this.product.professional);
      this.product.image.forEach((image, index) => {
        file.append(`images[${index}]`, image);
      })

      return file;
    },

    async storeProduct() {
      let file     = await this.fileAppend();
      const config = {
        headers: {"content-type": "multipart/form-data"}
      }
      axios.post('/admin/product/store', file, config)
          .then(() => {
            this.product = {};
            this.$toast.open({
              message: 'Successfully Product Created.',
              type   : 'success',
            });
            location.replace("/admin/product")
          })
          .catch(() => {

          })
          .finally(() => {
          })
    }
  }
}
</script>

<style scoped>

.form-group {
  margin-bottom : 13px !important;
}
</style>