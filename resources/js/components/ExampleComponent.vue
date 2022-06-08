<template>
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-12">
                    <div class="d-flex justify-content-center mt-2">
                        <button
                            class="btn btn-success"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#formModal"
                            @click="showCreate"
                        >
                            create
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">title</th>
                                <th scope="col">content</th>
                                <th scope="col">created at</th>
                                <th scope="col">updated at</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(data, index) in lists" :key="index">
                                <th scope="row">{{ data.id }}</th>
                                <td>{{ data.title }}</td>
                                <td>{{ data.content }}</td>
                                <td>{{ data.created_at }}</td>
                                <td>{{ data.updated_at }}</td>
                                <td>
                                    <button
                                        class="btn btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#formModal"
                                        @click="showEdit(data.id)"
                                    >
                                        edit
                                    </button>
                                    <button
                                        class="btn btn-danger"
                                        @click="sendDelete(data.id)"
                                    >
                                        delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-12">
                    <nav
                        aria-label="Page navigation"
                        class="d-flex justify-content-center"
                    >
                        <ul class="pagination">
                            <li
                                class="page-item"
                                v-for="(link, index) in pageLinks"
                                :key="index"
                                :class="{ active: link.active }"
                            >
                                <button
                                    class="page-link"
                                    @click="getPage(link.url)"
                                    :aria-label="link.label"
                                    :disabled="!link.url"
                                >
                                    <span v-html="link.label"></span>
                                </button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="formModal"
            tabindex="-1"
            aria-labelledby="formModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">
                            Announce Form
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="title">title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="title"
                                    placeholder="title"
                                    v-model="formData.title"
                                />
                            </div>
                            <div class="form-group">
                                <label for="content">content</label>
                                <textarea
                                    class="form-control"
                                    id="content"
                                    rows="3"
                                    placeholder="content"
                                    v-model="formData.content"
                                ></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="handleSubmit"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="mask align-items-center justify-content-center position-fixed top-0 start-0 w-100 h-100"
            :class="{
                'd-none': loadingCount === 0,
                'd-flex': loadingCount > 0,
            }"
        >
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {},
            lists: [],
            formType: "",
            opendId: null,
            pageLinks: [],
            loadingCount: 0,
        };
    },
    methods: {
        superFetch(url, config, callback) {
            this.loadingCount++;

            fetch(url, config)
                .then((response) => {
                    this.loadingCount--;

                    if (response.ok) {
                        return response.json();
                    }

                    return response.json().then((err) => {
                        throw err;
                    });
                })
                .then((data) => callback(data))
                .catch((err) => {
                    alert(JSON.stringify(err));
                });
        },
        showCreate() {
            this.formData = { title: "", content: "" };
            this.formType = "create";
        },
        showEdit(id) {
            this.superFetch(
                "./api/announce/" + id,
                {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                },
                (data) => {
                    this.formData = { ...data.data };
                    this.formType = "edit";
                    this.opendId = id;
                }
            );
        },
        handleSubmit() {
            if (this.formType === "create") {
                this.sendCreate();
            }

            if (this.formType === "edit") {
                this.sendEdit(this.opendId);
            }
        },
        sendCreate() {
            this.superFetch(
                "./api/announce/",
                {
                    method: "POST",
                    body: JSON.stringify(this.formData),
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                },
                () => {
                    this.getData();
                }
            );
        },
        sendEdit(id) {
            this.superFetch(
                "./api/announce/" + id,
                {
                    method: "PUT",
                    body: JSON.stringify(this.formData),
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                },
                () => {
                    this.getData();
                }
            );
        },
        sendDelete(id) {
            this.superFetch(
                "./api/announce/" + id,
                {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                },
                () => {
                    this.getData();
                }
            );
        },
        getData() {
            this.superFetch(
                "./api/announce/",
                {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                },
                (data) => {
                    this.lists = [...data.data.data];
                    this.pageLinks = [...data.data.links];
                }
            );
        },
        getPage(url) {
            this.superFetch(
                url,
                {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                },
                (data) => {
                    this.lists = [...data.data.data];
                    this.pageLinks = [...data.data.links];
                }
            );
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
