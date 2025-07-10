<template>
  <!--Start sidebar-wrapper-->
  <div id="sidebar-wrapper">
    <div class="brand-logo">
      <router-link :to="{ name: `adminDashboard` }" class="d-flex align-items-center">
        <img :src="`${get_setting_value('image') ?? 'avatar.png'} `" class="logo-icon" alt="logo icon" />
        <h5 class="logo-text">Super Admin Panel</h5>
      </router-link>
      <div class="close-btn">
        <i class="zmdi zmdi-close" @click="toggle_menu"></i>
      </div>
    </div>

    <div class="text-center mt-3">
      <img class="rounded-circle p-1" height="70" width="70" :src="`${auth_info.image ?? 'avatar.png'}`" alt="" />
      <p class="mt-2">Mr. {{ auth_info.name }}</p>
    </div>
    <hr />
    <ul class="metismenu" id="menu">
      <!-- <li class="menu-label">Management</li> -->
      <li>
        <router-link :to="{ name: `adminDashboard` }" class="border" href="javascript:void();">
          <div class="parent-icon">
            <i class="zmdi zmdi-view-dashboard"></i>
          </div>
          <div class="menu-title">Dashboard</div>
        </router-link>
      </li>
      <!-- Management start -->
      <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`User Management`" :menus="[
        {
          route_name: `AllUser`,
          title: `User`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
      ]" />

      <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`BlogManagement`" :menus="[
        {
          route_name: `AllBlogCategory`,
          title: `BlogCategory`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllBlogWriter`,
          title: `BlogWriter`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllBlog`,
          title: `Blog`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
      ]" />
      <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`CourseManagement`" :menus="[
        {
          route_name: `AllCourseCategory`,
          title: `CourseCategory`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllCourseInstructor`,
          title: `CourseInstructors`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllCourseBatch`,
          title: `CourseBatch`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllCourseBatchStudent`,
          title: `CourseBatchStudent`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllCourseMilestone`,
          title: `CourseMilestone`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllCourseModule`,
          title: `CourseModule`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllCourseModuleClass`,
          title: `CourseModuleClass`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllCourseModuleClassResourse`,
          title: `CourseModuleClassResourse`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllCourseModuleClassRoutine`,
          title: `CourseModuleClassRoutine`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllEnrollInformation`,
          title: `EnrollInformation`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
      ]" />

      <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`QuizManagement`" :menus="[
        {
          route_name: `AllQuizQuestionTopic`,
          title: `QuizQuestionTopic`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllQuizQuestion`,
          title: `QuizQuestion`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllQuiz`,
          title: `Quiz`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
      ]" />

      <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`WebsiteManagement`" :menus="[
        {
          route_name: `AllWebsiteMWebsiteBanner`,
          title: `WebsiteMWebsiteBanner`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllSubBanner`,
          title: `SubBanner`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllSuccssStory`,
          title: `SuccssStories`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllOurSpeciality`,
          title: `OurSpeciality`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllOurTrainer`,
          title: `OurTrainer`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllAboutU`,
          title: `AboutUs`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllWebsiteBrand`,
          title: `WebsiteBrand`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllOurMoto`,
          title: `OurMoto`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllOurMission`,
          title: `OurMission`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllOurVision`,
          title: `OurVision`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllOurTeam`,
          title: `OurTeam`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
      ]" />

      <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`GalleryManagement`" :menus="[
        {
          route_name: `AllGalleryCategory`,
          title: `GalleryCategory`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
        {
          route_name: `AllGallery`,
          title: `Gallery`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
      ]" />

      <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`ContactManagement`" :menus="[
        {
          route_name: `AllContactMessage`,
          title: `ContactMessage`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
      ]" />

      <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`PaymentManagement`" :menus="[
        {
          route_name: `AllPaymentGateway`,
          title: `PaymentGateways`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
      ]" />

      <side-bar-drop-down-menus :icon="`fa fa-plus`" :menu_title="`EmailManagement`" :menus="[
        {
          route_name: `AllEmailConfigure`,
          title: `EmailConfigures`,
          icon: `zmdi zmdi-dot-circle-alt`,
        },
      ]" />


   
      <!-- <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`Seminer`" :route_name="`AllSeminer`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`GalleryCategory`" :route_name="`AllGalleryCategory`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`Gallery`" :route_name="`AllGallery`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`ContactMessage`" :route_name="`AllContactMessage`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`WebsiteMWebsiteBanner`" :route_name="`AllWebsiteMWebsiteBanner`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`SubBanner`" :route_name="`AllSubBanner`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`SuccssStories`" :route_name="`AllSuccssStory`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`OurSpeciality`" :route_name="`AllOurSpeciality`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`OurTrainer`" :route_name="`AllOurTrainer`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`AboutUs`" :route_name="`AllAboutU`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`WebsiteBrand`" :route_name="`AllWebsiteBrand`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`OurMoto`" :route_name="`AllOurMoto`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`OurMission`" :route_name="`AllOurMission`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`OurVision`" :route_name="`AllOurVision`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`OurTeam`" :route_name="`AllOurTeam`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`BlogCategory`" :route_name="`AllBlogCategory`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`Blog`" :route_name="`AllBlog`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`BlogTag`" :route_name="`AllBlogTag`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`QuizQuestionTopic`"
        :route_name="`AllQuizQuestionTopic`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`QuizQuestion`" :route_name="`AllQuizQuestion`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`Quiz`" :route_name="`AllQuiz`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`CourseCategory`" :route_name="`AllCourseCategory`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`CourseInstructors`"
        :route_name="`AllCourseInstructor`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`CourseBatch`" :route_name="`AllCourseBatch`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`CourseBatchStudent`"
        :route_name="`AllCourseBatchStudent`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`Course`" :route_name="`AllCourse`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`CourseMilestone`" :route_name="`AllCourseMilestone`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`CourseModule`" :route_name="`AllCourseModule`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`CourseModuleClass`"
        :route_name="`AllCourseModuleClass`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`CourseModuleClassResourse`"
        :route_name="`AllCourseModuleClassResourse`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`CourseModuleClassRoutine`"
        :route_name="`AllCourseModuleClassRoutine`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`EnrollInformation`"
        :route_name="`AllEnrollInformation`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`PaymentGateways`" :route_name="`AllPaymentGateway`" />
      <side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`EmailConfigures`" :route_name="`AllEmailConfigure`" /> -->
      <!-- Management end -->
    </ul>
  </div>
</template>

<script>
//auth_store
import { auth_store } from "../../../../../GlobalStore/auth_store";
import { site_settings_store } from "../../../../../GlobalStore/site_settings_store";
import { mapState, mapActions } from "pinia";
//components
import SideBarDropDownMenus from "./SideBarDropDownMenus.vue";
import SideBarSingleMenu from "./SideBarSingleMenu.vue";
export default {
  components: { SideBarDropDownMenus, SideBarSingleMenu },
  methods: {
    ...mapActions(site_settings_store, {
      get_setting_value: "get_setting_value",
    }),

    logout_submit: function () {
      let confirm = window.confirm("logout");
      if (confirm) {
        this.log_out();
      }
    },
    toggle_menu: function () {
      document.getElementById("wrapper").classList.toggle("toggled");
    },
  },
  computed: {
    ...mapState(auth_store, {
      auth_info: "auth_info",
    }),
  },
};
</script>

<style></style>
<!-- <side-bar-drop-down-menus :icon="`fa fa-plus`" :icon_image="`https://files.etek.com.bd/images/icon_sales.png`"
    :menu_title="`title Management`" :menus="[
                {
                    route_name: `AllUser`,
                    title: `title`,
                    icon: `zmdi zmdi-dot-circle-alt`,
                },
            ]" /> -->
