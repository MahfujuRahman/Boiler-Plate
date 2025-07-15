<template>
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title"> Profile Settings</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card profile-card-2">
                    <div class="card-img-block">
                        <img :src="`${auth_info?.image ?? 'avatar.png'}`" alt="Card image cap"
                            class="img-fluid bg-dark m-auto d-flex justify-content-center">
                    </div>
                    <div class="card-body pt-5">
                        <img :src="`${auth_info?.image ?? 'avatar.png'}`" alt="profile-image" class="profile">
                        <h5 class="card-title text-capitalize">Name : {{ auth_info?.first_name || 'N/A' }} {{ auth_info?.last_name || '' }}</h5>
                        <p class="card-text">Email: {{ auth_info?.email || 'N/A' }}</p>
                        <p class="card-text">Phone: {{ auth_info?.address?.number || 'N/A' }}</p>
                        <p class="card-text">Address: {{ auth_info?.address?.address || 'N/A' }}</p>

                    </div>
                    <div class="card-body  border-light">
                        <div class="media align-items-center">
                            <div class="icon-block">
                                <a href="javascript:void();"><i class="fa fa-facebook bg-facebook text-white"></i></a>
                                <a href="javascript:void();"> <i class="fa fa-twitter bg-twitter text-white"></i></a>
                                <a href="javascript:void();"> <i
                                        class="fa fa-google-plus bg-google-plus text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                            <li class="nav-item" @click="tab = 'edit'">
                                <a :class="tab == 'edit' ? ' active' : ''" href="javascript:void();" data-target="#edit"
                                    data-toggle="pill" class="nav-link "><i class="icon-note"></i> <span
                                        class="hidden-xs">Edit</span></a>
                            </li>
                            <li class="nav-item" @click="tab = 'change_password'">
                                <a :class="tab == 'change_password' ? 'active' : ''" href="javascript:void();"
                                    data-target="#profile" data-toggle="pill" class="nav-link "><i
                                        class="icon-user"></i> <span class="hidden-xs">Change
                                        password</span></a>
                            </li>
                        </ul>
                        <div class="tab-content p-3">
                            <div v-if="tab == 'edit'" :class="tab == 'edit' ? ' active' : ''" class="tab-pane active"
                                id="profile">
                                <form @submit.prevent="UpdateProfileHandler" enctype="multipart/form-data" v-if="auth_info">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                        <div class="col-lg-9">
                                            <input v-model="auth_info.user_name" name="user_name" class="form-control"
                                                type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">First Name</label>
                                        <div class="col-lg-9">
                                            <input v-model="auth_info.first_name" name="first_name" class="form-control"
                                                type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Last Name</label>
                                        <div class="col-lg-9">
                                            <input v-model="auth_info.last_name" name="last_name" class="form-control"
                                                type="text">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input v-model="auth_info.email" name="email" class="form-control"
                                                type="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                                        <div class="col-lg-9">
                                            <input
                                                v-model="stateValue"
                                                name="state"
                                                class="form-control"
                                                type="text"
                                                :placeholder="(auth_info.address && auth_info.address.state) ? 'State' : 'Enter state'"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                        <div class="col-lg-9">
                                            <input
                                                v-model="cityValue"
                                                name="city"
                                                class="form-control"
                                                type="text"
                                                :placeholder="(auth_info.address && auth_info.address.city) ? 'City' : 'Enter city'"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Post</label>
                                        <div class="col-lg-9">
                                            <input
                                                v-model="postValue"
                                                name="post"
                                                class="form-control"
                                                type="text"
                                                :placeholder="(auth_info.address && auth_info.address.post) ? 'Post' : 'Enter post'"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Country</label>
                                        <div class="col-lg-9">
                                            <input
                                                v-model="countryValue"
                                                name="country"
                                                class="form-control"
                                                type="text"
                                                :placeholder="(auth_info.address && auth_info.address.country) ? 'Country' : 'Enter country'"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Change image</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="image" type="file">
                                            <img v-if="auth_info?.image" class="mt-2" :src="auth_info.image" height="100"
                                                width="100" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="submit" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <div v-if="tab == 'change_password'" :class="tab == 'change_password' ? ' active' : ''"
                                class="tab-pane" id="change_password">
                                <form @submit.prevent="ChangePasswordHandler">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Current
                                            password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="current_password" type="password"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">New password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="new_password" type="password" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Confirm New
                                            password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" name="confirm_new_password" type="password"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="submit" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div v-if="tab == 'message'" :class="tab == 'message' ? ' active' : ''" class="tab-pane"
                                id="message">
                                <table class="table table-striped table-active table-bordered">
                                    <tr v-for="i in 5" :key="i">
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End container-fluid-->
</template>

<script>
import { auth_store } from "../../../../../GlobalStore/auth_store";
import { settings_store } from "../store/store";
import { mapState, mapActions } from 'pinia';
export default {
    data: () => ({
        tab: 'edit',
        phoneNumbers: [],
        socialMediaLinks: [],
        tempState: '', // for when address is null
        tempCity: '',
        tempPost: '',
        tempCountry: '',
    }),
    created() {
        // Initialize auth_info with default structure if null
        if (!this.auth_info) {
            this.check_is_auth();
        }
    },

    watch: {
        auth_info: {
            handler(newValue) {
                if (newValue && newValue.address) {
                    // Initialize phone numbers
                    if (newValue.address.phone_number) {
                        try {
                            const phoneData = typeof newValue.address.phone_number === 'string'
                                ? JSON.parse(newValue.address.phone_number)
                                : newValue.address.phone_number;
                            this.phoneNumbers = Array.isArray(phoneData) ? phoneData.filter(phone => phone) : [];
                        } catch (error) {
                            // If it's not JSON, treat as single phone number
                            this.phoneNumbers = newValue.address.phone_number ? [newValue.address.phone_number] : [];
                        }
                    }

                    // Initialize social media links from social_links array
                    if (newValue.social_links && Array.isArray(newValue.social_links)) {
                        this.socialMediaLinks = newValue.social_links.map(item => ({
                            media_name: item.media_name,
                            media_link: item.link
                        }));
                    } else if (newValue.address && newValue.address.social_media) {
                        try {
                            const socialData = typeof newValue.address.social_media === 'string'
                                ? JSON.parse(newValue.address.social_media)
                                : newValue.address.social_media;

                            // Ensure the data structure matches backend expectations
                            if (Array.isArray(socialData)) {
                                this.socialMediaLinks = socialData.map(item => {
                                    if (typeof item === 'object' && item.media_name && (item.media_link || item.link)) {
                                        return {
                                            media_name: item.media_name,
                                            media_link: item.media_link || item.link
                                        };
                                    }
                                    return null;
                                }).filter(item => item !== null);
                            } else {
                                this.socialMediaLinks = [];
                            }
                        } catch (error) {
                            this.socialMediaLinks = [];
                        }
                    } else {
                        this.socialMediaLinks = [];
                    }
                }
            },
            immediate: true,
            deep: true
        }
    },
    methods: {
        ...mapActions(auth_store, {
            check_is_auth: 'check_is_auth',
        }),
        UpdateProfileHandler: async function () {
            if (!this.auth_info) {
                window.s_alert('User information not available', 'error');
                return;
            }

            let formData = new FormData(event.target);

            // Add phone numbers and social media as JSON strings
            formData.append('phone_numbers', JSON.stringify(this.phoneNumbers || []));
            formData.append('social_media', JSON.stringify(this.socialMediaLinks || []));

            try {
                let response = await axios.post('user-profile-update', formData);
                if (response.data.status == 'success') {
                    window.s_alert(response.data.message)
                    this.check_is_auth()
                } else {
                    window.s_alert(response.data.message || 'Update failed', 'error')
                }
            } catch (error) {
                window.s_alert('Network error occurred', 'error');
            }
        },
        ChangePasswordHandler: async function () {
            if (!this.auth_info) {
                window.s_alert('User information not available', 'error');
                return;
            }

            try {
                let formData = new FormData(event.target);
                let response = await axios.post('user-change-password', formData);
                if (response.data.status == 'success') {
                    window.s_alert(response.data.message)
                    this.check_is_auth()
                } else {
                    window.s_alert(response.data.message || 'Password change failed', 'error')
                }
            } catch (error) {
                window.s_alert('Network error occurred', 'error');
            }
        }
    },
    computed: {
        ...mapState(auth_store, {
            auth_info: 'auth_info',
        }),
        stateValue: {
            get() {
                if (this.auth_info && this.auth_info.address) {
                    return this.auth_info.address.state || '';
                }
                return this.tempState;
            },
            set(val) {
                if (this.auth_info && this.auth_info.address) {
                    this.auth_info.address.state = val;
                } else {
                    this.tempState = val;
                }
            }
        },
        cityValue: {
            get() {
                if (this.auth_info && this.auth_info.address) {
                    return this.auth_info.address.city || '';
                }
                return this.tempCity;
            },
            set(val) {
                if (this.auth_info && this.auth_info.address) {
                    this.auth_info.address.city = val;
                } else {
                    this.tempCity = val;
                }
            }
        },
        postValue: {
            get() {
                if (this.auth_info && this.auth_info.address) {
                    return this.auth_info.address.post || '';
                }
                return this.tempPost;
            },
            set(val) {
                if (this.auth_info && this.auth_info.address) {
                    this.auth_info.address.post = val;
                } else {
                    this.tempPost = val;
                }
            }
        },
        countryValue: {
            get() {
                if (this.auth_info && this.auth_info.address) {
                    return this.auth_info.address.country || '';
                }
                return this.tempCountry;
            },
            set(val) {
                if (this.auth_info && this.auth_info.address) {
                    this.auth_info.address.country = val;
                } else {
                    this.tempCountry = val;
                }
            }
        }
    },
}
</script>

<style></style>
