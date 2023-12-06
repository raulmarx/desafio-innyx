import { useAuthStore } from "@/stores/auth.js";

export default async function routes(to, from, next) {
    if (!to.name) {
        next({ name: 'defaultRoute' }); 
        return;
    }
    if (to.meta?.auth) {
        const auth = useAuthStore();    
        if (auth.token && auth.user) {
          next();
        }        
        else {
          next({ name: "login" });
        }
      }
      else if (to.name === "login") {
        next();
      }
      else if (to.name === "register") {
        next();
      }
      else {
        next(false);
      }
}
