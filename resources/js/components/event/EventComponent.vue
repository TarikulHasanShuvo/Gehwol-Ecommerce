<template>
  <div class="row">
    <div class="col">
      <div class="page-heading">
        <h3>Event List</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-title text-end p-4">
                <button class="btn btn-primary" @click="editMode=false; openModal()">Add New Event</button>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-lg">
                      <thead>
                      <tr>
                        <th>UID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Author</th>
                        <th>Total Seat</th>
                        <th>Type</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="event in events" :key="event.id">
                        <td class="text-bold-500">{{ event.uid }}</td>
                        <td class="text-bold-500">{{ event.name }}</td>
                        <td class="text-bold-500">{{ event.date }}</td>
                        <td class="text-bold-500">{{ event.time_from }} - {{ event.time_to }}</td>
                        <td class="text-bold-500">{{ event.author }}</td>
                        <td class="text-bold-500">{{ event.total_seat }}</td>
                        <td class="text-bold-500">{{ event.type }}</td>
                        <td class="text-bold-500">
                          <button class="btn btn-warning btn-sm pt-2" type="button"
                                  @click="editEventModal(event)">
                            <i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger btn-sm pt-2 ms-1" type="button"
                                  @click="deleteEvent(event.id)"><i
                              class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                  <div v-if="events.length ==0 " class="no-product text-center mt-2">
                    <h2>No Event Found</h2>
                  </div>
                  <div class="mt-5">
                    <pagination align="center" :data="pagination" @pagination-change-page="getEvents">
                      <span slot="prev-nav">&lt; Previous</span>
                      <span slot="next-nav">Next &gt;</span>
                    </pagination>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <div id="createEventModal" aria-labelledby="createEventModal" aria-modal="true"
             class="modal fade text-left show" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <form @submit.prevent="editMode ? updateEvent(event.id) : storeEvent()">
                <div class="modal-header bg-primary">
                  <h5 class="modal-title white">
                    {{ editMode ? "Edit" : "Add" }}
                    Event
                  </h5>
                  <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                    <i data-feather="x"></i>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input v-model="event.name" class="form-control" placeholder="Event Name" required type="text">
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Date</label>
                        <input v-model="event.date" class="form-control" required type="date">
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Time From</label>
                            <select v-model="event.time_from" class="form-select" required>
                              <option value="">Select Time</option>
                              <option value="06:00:00">06:00</option>
                              <option value="07:00:00">07:00</option>
                              <option value="08:00:00">08:00</option>
                              <option value="09:00:00">09:00</option>
                              <option value="10:00:00">10:00</option>
                              <option value="11:00:00">11:00</option>
                              <option value="12:00:00">12:00</option>
                              <option value="12:00:00">12:00</option>
                              <option value="13:00:00">13:00</option>
                              <option value="14:00:00">14:00</option>
                              <option value="15:00:00">15:00</option>
                              <option value="16:00:00">16:00</option>
                              <option value="17:00:00">17:00</option>
                              <option value="18:00:00">18:00</option>
                              <option value="19:00:00">19:00</option>
                              <option value="20:00:00">20:00</option>
                              <option value="21:00:00">21:00</option>
                              <option value="22:00:00">22:00</option>
                              <option value="23:00:00">23:00</option>
                              <option value="24:00:00">24:00</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Time To</label>
                            <select v-model="event.time_to" class="form-select" required>
                              <option value="">Select Time</option>
                              <option value="06:00:00">06:00</option>
                              <option value="07:00:00">07:00</option>
                              <option value="08:00:00">08:00</option>
                              <option value="09:00:00">09:00</option>
                              <option value="10:00:00">10:00</option>
                              <option value="11:00:00">11:00</option>
                              <option value="12:00:00">12:00</option>
                              <option value="12:00:00">12:00</option>
                              <option value="13:00:00">13:00</option>
                              <option value="14:00:00">14:00</option>
                              <option value="15:00:00">15:00</option>
                              <option value="16:00:00">16:00</option>
                              <option value="17:00:00">17:00</option>
                              <option value="18:00:00">18:00</option>
                              <option value="19:00:00">19:00</option>
                              <option value="20:00:00">20:00</option>
                              <option value="21:00:00">21:00</option>
                              <option value="22:00:00">22:00</option>
                              <option value="23:00:00">23:00</option>
                              <option value="24:00:00">24:00</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Author</label>
                    <input v-model="event.author" class="form-control" placeholder="Author Name" required
                           type="text">
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Total Seat</label>
                        <input v-model="event.total_seat" class="form-control" required type="number">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Event Type</label>
                        <select v-model="event.type" class="form-select" required>
                          <option value="">Select Event Type</option>
                          <option value="Virtual">Virtual</option>
                        </select>
                      </div>
                    </div>
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

        <div id="eventDeleteConfirmationModal" class="modal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Delete Event</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"
                        @click="closeConfirmModal"></button>
              </div>
              <div class="modal-body">
                <p>Are you sure want to delete this event?</p>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button" @click="closeConfirmModal">
                  Cancel
                </button>
                <button class="btn btn-primary" type="button" @click="deleteEvent">Yes</button>
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
      event: {},
      events: [],
      editMode: false,
      deleteEventId: '',
      pagination: {}
    }
  },

  mounted() {
    this.getEvents();
  },

  methods: {
    getEvents(page = 1) {
      axios.get('/api/v1/admin/events?page=' + page)
              .then((response) => {
                this.pagination = response.data;
                this.events     = response.data.data;
              }, (err) => {
                console.log(err.response);
              })
    },

    openModal() {
      if (!this.editMode) {
        this.editMode = false;
        this.event= {
          type: "Virtual",
          name: "",
          date: "",
          time_from: "",
          time_to: "",
          total_seat:50,
          author:""
        };
      }
      document.querySelector("#createEventModal").style.display    = 'block';
      document.querySelector("#createEventModal").style.background = 'rgba(0,0,0,.5)';
    },

    closeModal() {
      document.querySelector("#createEventModal").style.display = 'none';
    },

    editEventModal(event) {
      this.event = {...event};
      this.editMode = true;
      this.openModal();
    },

    updateEvent(id) {
      axios.put(`/api/v1/admin/events/${id}`, this.event)
          .then((res) => {
            this.$toast.open({
              message: 'Event Successfully Updated.',
              type   : 'success',
            });
            document.querySelector("#createEventModal").style.display = 'none';
            this.event= {};
            this.events = this.events.map((item)=> {
                            if(item.id === res.data.data.id) {
                              item = res.data.data;
                            }
                            return item;
                          })
          }, (err)=> {
            this.$toast.open({
              message: err.response.data.message,
              type   : 'error',
            });
          })
    },
    storeEvent() {
      axios.post('/api/v1/admin/events', this.event)
          .then(() => {
            this.$toast.open({
              message: 'Event Successfully Created.',
              type   : 'success',
            });
            document.querySelector("#createEventModal").style.display = 'none';
            this.event= {};
            this.getEvents();
          }, (err)=> {
            this.$toast.open({
              message: err.response.data.message,
              type   : 'error',
            });
          })
    },

    openConfirmModal(id) {
      this.deleteEventId                                                       = id;
      document.querySelector("#eventDeleteConfirmationModal").style.display    = 'block';
      document.querySelector("#eventDeleteConfirmationModal").style.background = 'rgba(0,0,0,.5)';
    },

    closeConfirmModal() {
      document.querySelector("#eventDeleteConfirmationModal").style.display = 'none';
    },

    deleteEvent(id) {
      this.$swal.fire({
        title             : 'Are you sure?',
        text              : "You won't delete this event !",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/api/v1/admin/events/${id}`)
              .then((response) => {
                this.events = this.events.filter((item)=> {
                                return item.id !== id
                              });
                this.$swal.fire(
                        'Deleted!',
                        'Successfully Event Deleted.',
                        'success'
                )
              }, (err)=> {
                this.$toast.open({
                  message: err.response.data.message,
                  type   : 'error',
                });
              })

        }
      })

    }
  }
}
</script>

<style lang="scss" scoped>

</style>
