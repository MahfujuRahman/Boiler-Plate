//app layout
import Layout from "../Layouts/Layout.vue";
//Dashboard
import Dashboard from "../Management/Dashboard/Dashboard.vue";
//SettingsRoutes
import SettingsRoutes from "../Management/Settings/setup/routes.js";
//UserRoutes
import UserRoutes from "../Management/UserManagement/User/setup/routes.js";
//routes
import GalleryRoutes from '../../../GlobalManagement/GalleryManagement/Gallery/setup/routes.js';
import GalleryCategoryRoutes from '../../../GlobalManagement/GalleryManagement/GalleryCategory/setup/routes.js';



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
        GalleryRoutes,
        GalleryCategoryRoutes,
      

    //user routes
    UserRoutes,
    //settings
    SettingsRoutes,
  ],
};

export default routes;
