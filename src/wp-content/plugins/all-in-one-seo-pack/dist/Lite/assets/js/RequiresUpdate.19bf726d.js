import{f as a}from"./links.813d802e.js";import{a as r}from"./addons.6651d172.js";function u({next:n,router:t,to:e}){return a().isUnlicensed||!r.isActive(e.meta.middlewareData.addon)?(n(),t.push({name:e.meta.middlewareData.routeName}).catch(()=>{})):n()}function c({next:n,router:t,to:e}){return a().isUnlicensed||!r.hasMinimumVersion(e.meta.middlewareData.addon)?(n(),t.push({name:e.meta.middlewareData.routeName}).catch(()=>{})):n()}export{u as R,c as a};
