export const navigationLinks = [
    {name: "Dashboard", link: false, border: false},
    {
        name: "Dashboard",
        link: true,
        border: false,
        startWith: "/dashboard",
        route: "dashboard",
        icon: "HomeIcon",
        // children:[],
    },
    { name: "Administrative", link: false, border: false },
    {
        name: "Users",
        link: true,
        border: false,
        startWith: "/users",
        route: "users.all",
        icon: "UsersIcon",
        // children:[],
    },
    {
        name: "Device Approval List",
        link: true,
        border: false,
        startWith: "/auth_request",
        route: "auth_request.index",
        icon: "DeviceTabletIcon",
        // children:[],
    },

];
  