import"./js/vue2.d65b22aa.js";import{j as C,o as g,c as b,a as d,H as h,D as k,I as O,u as R,t as N,d as U,Y as w,A as V,a0 as W,h as F}from"./js/vue.esm-bundler.7598fd57.js";import{c as z,b as H}from"./js/vue-router.bbbc3185.js";import{e as $,l as M}from"./js/index.a33da2f9.js";import{l as A}from"./js/index.dfdc56df.js";import{b as I,f as j,v as Q,l as D}from"./js/links.813d802e.js";import{a as Y,m as G,T as J}from"./js/postSlug.9f9109e2.js";import{d as u,a as K}from"./js/Caret.13c1041f.js";import{b as X}from"./js/_baseSet.04ee5bb4.js";import{i as Z}from"./js/DatePicker.f7c04d7d.js";import{_ as tt}from"./js/default-i18n.3881921e.js";import{l as et}from"./js/index.0b123ab1.js";import{M as ot}from"./js/Modal.89c8c5ce.js";import"./js/translations.6e7b2383.js";import"./js/constants.2883a7a9.js";import"./js/_plugin-vue_export-helper.c114f5e4.js";import"./js/isArrayLikeObject.5519e7e6.js";import"./js/metabox.7825ad87.js";import"./js/cleanForSlug.ea66364b.js";import"./js/toString.8b13982a.js";import"./js/_baseTrim.8725856f.js";import"./js/_stringToArray.4de3b1f3.js";import"./js/get.31082aba.js";import"./js/isUndefined.2431eba9.js";import"./js/_getTag.61c0a63c.js";import"./js/debounce.4990a8b5.js";import"./js/toNumber.c4afc119.js";import"./js/ScoreButton.aec6eb4d.js";import"./js/App.45211312.js";/* empty css                */import"./js/allowed.ea569dbe.js";import"./js/params.f0608262.js";import"./js/JsonValues.870a4901.js";import"./js/SettingsRow.6980606f.js";import"./js/Row.cd3858a9.js";import"./js/Checkbox.f60a350d.js";import"./js/Checkmark.1f5c43de.js";import"./js/ScrollAndHighlight.b5ba47fd.js";import"./js/LogoGear.e54c732a.js";import"./js/Tabs.c4ec03a5.js";import"./js/TruSeoScore.b474bf15.js";import"./js/Ellipse.6b410f74.js";import"./js/Information.8ca58f92.js";import"./js/Slide.8d21c232.js";import"./js/Index.39eb7788.js";import"./js/Settings.889fb822.js";import"./js/MaxCounts.12b45bab.js";import"./js/Tags.cdd83172.js";import"./js/tags.0758d75f.js";import"./js/regex.ebd490ab.js";import"./js/toFinite.c9388fb8.js";import"./js/Tooltip.446bcf89.js";import"./js/Plus.665d7f88.js";import"./js/Eye.8bf7678c.js";import"./js/RadioToggle.f7266970.js";import"./js/GoogleSearchPreview.3b17e4b4.js";import"./js/strings.92be37f9.js";import"./js/isString.bfa01f62.js";import"./js/HtmlTagsEditor.bc38613a.js";import"./js/Editor.7de59de4.js";import"./js/UnfilteredHtml.b3fec4c8.js";import"./js/ProBadge.f9c9ae69.js";import"./js/popup.6fe74774.js";import"./js/license.e3b96863.js";import"./js/upperFirst.67708519.js";import"./js/addons.6651d172.js";import"./js/Blur.dfbd44b9.js";import"./js/Index.bc260cfc.js";import"./js/WpTable.7aa38f5b.js";import"./js/Table.8398081c.js";import"./js/numbers.c7cb4085.js";import"./js/PostTypes.e5795f0f.js";import"./js/InternalOutbound.3c6ad955.js";import"./js/RequiredPlans.d12c09c3.js";import"./js/Image.c496de4f.js";import"./js/FacebookPreview.496c51a9.js";import"./js/Img.df6015ec.js";import"./js/Profile.084b493b.js";import"./js/ImageUploader.d8b01b3e.js";import"./js/TwitterPreview.cdcd16f0.js";import"./js/Book.60961e3d.js";import"./js/Build.8a3c5154.js";import"./js/Redirects.6a7a7f66.js";import"./js/Index.31b51bb3.js";import"./js/External.5ab1faaf.js";import"./js/Exclamation.3ebc8239.js";import"./js/Gear.e267ac3b.js";import"./js/Date.17e52d00.js";import"./js/Card.68c5f6b2.js";import"./js/Upsell.930be91d.js";function E(t,e,o){return t==null?t:X(t,e,o)}const q=t=>t.parentElement.removeChild(t),T=()=>{const t=_();document.body.classList.toggle("aioseo-settings-bar-is-active",t),document.body.classList.toggle("aioseo-settings-bar-is-inactive",!t)},st=()=>{const t=v();c(document.body,"aioseo-settings-bar-is"),document.body.classList.add(`aioseo-settings-bar-is-${t}`),f(t)},it=t=>{const e=document.getElementById(t);return e.contentWindow?e.contentWindow.document:e.contentDocument},nt=()=>{p.addEventListener("change",()=>{P(),f(v())}),mt.observe(document.querySelector(".et-fb-page-settings-bar"),{attributeFilter:["class"]}),document.addEventListener("click",y),it("et-fb-app-frame").addEventListener("click",y),i.addEventListener("click",()=>{const t=new Event("aioseo-pagebuilder-toggle-modal");document.dispatchEvent(t)})},rt=()=>{const t=v();c(document.body,"aioseo-settings-bar-is"),document.body.classList.add(`aioseo-settings-bar-is-${t}`),T(),P(),lt()||f(t)},P=()=>{x()&&(i=q(i))},f=t=>{if(x())return;const e=document.querySelector(".et-fb-page-settings-bar"),o=e.querySelector(".et-fb-page-settings-bar__toggle-button"),s=e.querySelectorAll(".et-fb-page-settings-bar__column");if(at(t),_())if(p.matches){const n=[...s].filter(r=>r.classList.contains("et-fb-page-settings-bar__column--main"));n.length&&n[0].appendChild(i)}else{const n=[...s].filter(r=>r.classList.contains("et-fb-page-settings-bar__column--left"));n.length&&n[0].insertBefore(i)}else o.insertAdjacentElement("afterend",i)},at=t=>{c(i,"aioseo-settings-bar-root"),i.classList.add(`aioseo-settings-bar-root-${t}`),c(i,"aioseo-settings-bar-root-is-mobile"),["aioseo-settings-bar-root-is-mobile",`aioseo-settings-bar-root-is-mobile-${t}`].forEach(s=>{i.classList.toggle(s,!p.matches)}),c(i,"aioseo-settings-bar-root-is-desktop"),["aioseo-settings-bar-root-is-desktop",`aioseo-settings-bar-root-is-desktop-${t}`].forEach(s=>{i.classList.toggle(s,p.matches)})},c=(t,e)=>{const o=[`${e}-left`,`${e}-right`,`${e}-top`,`${e}-top-left`,`${e}-top-right`,`${e}-bottom`,`${e}-bottom-left`,`${e}-bottom-right`];t.classList.remove(...o)},v=()=>{const t=document.querySelector(".et-fb-page-settings-bar").classList;return t.contains("et-fb-page-settings-bar--horizontal")&&!t.contains("et-fb-page-settings-bar--top")?"bottom":t.contains("et-fb-page-settings-bar--top")&&!t.contains("et-fb-page-settings-bar--corner")?"top":t.contains("et-fb-page-settings-bar--bottom-corner")?t.contains("et-fb-page-settings-bar--left-corner")?"bottom-left":"bottom-right":t.contains("et-fb-page-settings-bar--top-corner")?t.contains("et-fb-page-settings-bar--left-corner")?"top-left":"top-right":t.contains("et-fb-page-settings-bar--vertical--right")?"right":t.contains("et-fb-page-settings-bar--vertical--left")?"left":""},y=t=>{if(!ct())return;const e=t.target,o=".aioseo-pagebuilder-modal",s=".aioseo-app.aioseo-post-settings-modal";if(!e.closest(o)&&!e.closest(s)&&!(e!==document.querySelector(o)&&e.contains(document.querySelector(o)))&&e.getAttribute("class")&&!e.getAttribute("class").includes("aioseo")&&e!==i){const n=new Event("aioseo-pagebuilder-toggle-modal",{open:!1});document.dispatchEvent(n)}},ct=()=>!document.querySelector(".aioseo-pagebuilder-modal").classList.contains("aioseo-pagebuilder-modal-is-closed"),x=()=>document.documentElement!==i&&document.documentElement.contains(i),_=()=>document.querySelector(".et-fb-page-settings-bar").classList.contains("et-fb-page-settings-bar--active"),lt=()=>document.querySelector(".et-fb-page-settings-bar").classList.contains("et-fb-page-settings-bar--dragged")&&!_(),p=window.matchMedia("(min-width: 768px)"),mt=new MutationObserver(rt),pt="#aioseo-settings";let i=document.querySelector(pt);i=q(i);const dt=()=>{T(),st(),nt()};let B={};const l=()=>{if(document.documentElement.classList.contains("et-fb-preview--wireframe"))return;const t={...B},e=Y();Z(t,e)||(B=e,G())},ut=()=>{const t=I();t.saveCurrentPost(t.currentPost).then(()=>{const e=j(),o=Q();e.isUnlicensed||o.fetch()})},gt=({wp:t,addEventListener:e})=>{var o;l(),e("message",s=>{s.data.eventType==="et_fb_section_content_change"&&u(l,1e3)}),(o=t==null?void 0:t.hooks)==null||o.addFilter("et.builder.store.setting.update","aioseo",(s,n)=>{if(s)switch(n){case"et_pb_post_settings_title":E(ETBuilderBackendDynamic,"postTitle",s),u(l,1e3);break;case"et_pb_post_settings_excerpt":E(ETBuilderBackendDynamic,"postMeta.post_excerpt",s),u(l,1e3);break}return s}),document.querySelector(".et-fb-button--save-draft, .et-fb-button--publish").addEventListener("click",ut)};const bt={class:"aioseo-limit-modified-date-divi"},ft={class:"et-fb-button-group"},vt={key:0,class:"aioseo-limit-modified-date-divi__options et-fb-button-group"},_t={__name:"App",props:{buttonTitle:String,buttonEvent:String},setup(t){const e=C(!1),o=t,s=()=>{e.value=!1,$.emit(o.buttonEvent)};return(n,r)=>(g(),b("div",bt,[d("div",ft,[d("button",{class:"aioseo-limit-modified-date-divi__button-toggle et-fb-button et-fb-button--elevate et-fb-button--success",onClick:r[0]||(r[0]=h(Lt=>e.value=!e.value,["prevent"]))},[k(R(K),{class:O({rotated:!e.value})},null,8,["class"])])]),e.value?(g(),b("div",vt,[d("button",{class:"et-fb-button et-fb-button--elevate et-fb-button--success",onClick:h(s,["prevent"])},N(o.buttonTitle),1)])):U("",!0)]))}},a={id:"aioseo-limit-modified-date-divi",param:"aioseo_limit_modified_date",event:"save-limit-modified-date",title:tt("Save (Don't Modify Date)","all-in-one-seo-pack")},S=()=>document.querySelector(".et-fb-button--publish"),St=()=>{const t=document.createElement("div");t.id=a.id,S().insertAdjacentElement("afterend",t);let e=w({..._t,name:"Standalone/Divi/LimitModifiedDate"},{buttonTitle:a.title,buttonEvent:a.event});e=M(e),e=A(e),e=et(e),D(e),e.mount(`#${a.id}`)},ht=({ET_Builder:t})=>{$.on(a.event,()=>{const{conditionalTags:e}=t.Frames.app.frameElement.contentWindow.ETBuilderBackend;e[a.param]=!0,S().click(),delete e[a.param]})},Et=t=>{S()&&(St(),ht(t))},L={__name:"App",setup(t){const e=C(!1),o=()=>{e.value=!e.value};return V(()=>{document.addEventListener("aioseo-pagebuilder-toggle-modal",o)}),W(()=>{document.removeEventListener("aioseo-pagebuilder-toggle-modal",o)}),(s,n)=>(g(),b("div",null,[k(ot,{"is-open":e.value,"onUpdate:isOpen":n[0]||(n[0]=r=>e.value=r)},null,8,["is-open"])]))}};let m=null;const yt=()=>{const t=z({history:H(),routes:[{path:"/",component:L}]});let e=w({name:"Standalone/Divi",data(){return{tableContext:window.aioseo.currentPost.context,screenContext:"sidebar"}},render:()=>F(L)});return e=M(e),e=A(e),e.use(t),t.app=e,D(e,t),e.config.globalProperties.$truSeo=new J,e.mount("#aioseo-app-modal > div"),e},Bt=()=>{dt(),m==null||m.unmount(),m=yt(),gt(window),Et(window)};window.addEventListener("message",function(t){t.data.eventType==="et_builder_api_ready"&&Bt()});
