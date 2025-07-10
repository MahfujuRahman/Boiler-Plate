//app layout
import Layout from "../Layouts/Layout.vue";
//Dashboard
import Dashboard from "../Management/Dashboard/Dashboard.vue";
//SettingsRoutes
import SettingsRoutes from "../Management/Settings/setup/routes.js";
//UserRoutes
import UserRoutes from "../Management/UserManagement/User/setup/routes.js";
//routes
import EmailConfiguresRoutes from '../Management/EmailConfigures/setup/routes.js';
import PaymentGatewaysRoutes from '../Management/PaymentGateways/setup/routes.js';
import EnrollInformationRoutes from '../Management/EnrollInformation/setup/routes.js';
import CourseModuleClassRoutineRoutes from '../Management/CourseManagement/CourseModuleClassRoutine/setup/routes.js';
import CourseModuleClassResourseRoutes from '../Management/CourseManagement/CourseModuleClassResourse/setup/routes.js';
import CourseModuleClassRoutes from '../Management/CourseManagement/CourseModuleClass/setup/routes.js';
import CourseModuleRoutes from '../Management/CourseManagement/CourseModule/setup/routes.js';
import CourseMilestoneRoutes from '../Management/CourseManagement/CourseMilestone/setup/routes.js';
import CourseRoutes from '../Management/CourseManagement/Course/setup/routes.js';
import CourseBatchStudentRoutes from '../Management/CourseManagement/CourseBatch/CourseBatchStudent/setup/routes.js';
import CourseBatchRoutes from '../Management/CourseManagement/CourseBatch/setup/routes.js';
import CourseInstructorsRoutes from '../Management/CourseManagement/CourseInstructors/setup/routes.js';
import CourseCategoryRoutes from '../Management/CourseManagement/CourseCategory/setup/routes.js';
import QuizRoutes from '../Management/QuizManagement/Quiz/setup/routes.js';
import QuizQuestionRoutes from '../Management/QuizManagement/QuizQuestion/setup/routes.js';
import QuizQuestionTopicRoutes from '../Management/QuizManagement/QuizQuestionTopic/setup/routes.js';
import BlogTagRoutes from '../Management/BlogManagement/BlogTag/setup/routes.js';
import BlogRoutes from '../Management/BlogManagement/Blog/setup/routes.js';
import BlogCategoryRoutes from '../Management/BlogManagement/BlogCategory/setup/routes.js';
import OurTeamRoutes from '../Management/WebsiteManagement/OurTeam/setup/routes.js';
import OurVisionRoutes from '../Management/WebsiteManagement/OurVision/setup/routes.js';
import OurMissionRoutes from '../Management/WebsiteManagement/OurMission/setup/routes.js';
import OurMotoRoutes from '../Management/WebsiteManagement/OurMoto/setup/routes.js';
import WebsiteBrandRoutes from '../Management/WebsiteManagement/WebsiteBrand/setup/routes.js';
import AboutUsRoutes from '../Management/WebsiteManagement/AboutUs/setup/routes.js';
import OurTrainerRoutes from '../Management/WebsiteManagement/OurTrainer/setup/routes.js';
import OurSpecialityRoutes from '../Management/WebsiteManagement/OurSpeciality/setup/routes.js';
import SuccssStoriesRoutes from '../Management/WebsiteManagement/SuccssStories/setup/routes.js';
import SubBannerRoutes from '../Management/WebsiteManagement/SubBanner/setup/routes.js';
import WebsiteMWebsiteBannerRoutes from '../Management/WebsiteManagement/WebsiteMWebsiteBanner/setup/routes.js';
import ContactMessageRoutes from '../Management/CommunicationManagement/ContactMessage/setup/routes.js';
import GalleryRoutes from '../Management/GalleryManagement/Gallery/setup/routes.js';
import GalleryCategoryRoutes from '../Management/GalleryManagement/GalleryCategory/setup/routes.js';
import SeminerRoutes from '../Management/SeminerManagement/Seminer/setup/routes.js';

import BlogWriterRoutes from '../Management/BlogManagement/BlogWriter/setup/routes.js';
// import BlogRoutes from '../Management/BlogManagement/Blog/setup/routes.js';
// import BlogCategoryRoutes from '../Management/BlogManagement/BlogCategory/setup/routes.js';

const routes = {
  path: "",
  component: Layout,
  children: [
    {
      path: "dashboard",
      component: Dashboard,
      name: "adminDashboard",
    },
    //management routes
        EmailConfiguresRoutes,
        PaymentGatewaysRoutes,
        EnrollInformationRoutes,
        CourseModuleClassRoutineRoutes,
        CourseModuleClassResourseRoutes,
        CourseModuleClassRoutes,
        CourseModuleRoutes,
        CourseMilestoneRoutes,
        CourseRoutes,
        CourseBatchStudentRoutes,
        CourseBatchRoutes,
        CourseInstructorsRoutes,
        CourseCategoryRoutes,
        QuizRoutes,
        QuizQuestionRoutes,
        QuizQuestionTopicRoutes,
        BlogTagRoutes,
        BlogRoutes,
        BlogCategoryRoutes,
        OurTeamRoutes,
        OurVisionRoutes,
        OurMissionRoutes,
        OurMotoRoutes,
        WebsiteBrandRoutes,
        AboutUsRoutes,
        OurTrainerRoutes,
        OurSpecialityRoutes,
        SuccssStoriesRoutes,
        SubBannerRoutes,
        WebsiteMWebsiteBannerRoutes,
        ContactMessageRoutes,
        GalleryRoutes,
        GalleryCategoryRoutes,
        SeminerRoutes,

        BlogWriterRoutes,
        BlogRoutes,
        BlogCategoryRoutes,





    //user routes
    UserRoutes,
    //settings
    SettingsRoutes,
  ],
};

export default routes;
