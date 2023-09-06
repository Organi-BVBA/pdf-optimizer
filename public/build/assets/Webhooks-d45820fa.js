import{A as L}from"./AppLayout-7ba8edcf.js";import{T as j}from"./Tag-e949023c.js";import{L as W,K as g,M as D,o as s,e as c,c as h,w as d,g as i,N as f,a as t,t as m,F as v,i as w,n as N,f as k,j as $,q as _,O as T,b}from"./app-023ef01f.js";import{_ as y}from"./_plugin-vue_export-helper-c27b6911.js";const z={components:{"inertia-link":W},props:{links:{type:Object,default:()=>{}},meta:{type:Object,default:()=>{}}},computed:{pageLinks(){const a=g.parse(window.location.search.substr(1)),o=D.range(1,this.meta.last_page+1).map(u=>(a.page=u,{label:u,url:`${this.meta.path}?${g.stringify(a,{encodeValuesOnly:!0})}`,active:u===this.meta.current_page}));return o.length>7?this.trimPageRange(o):o},prevPage(){const e=g.parse(window.location.search.substr(1));return e.page=e.page?parseFloat(e.page):1,e.page>1?(e.page=e.page-1,`${this.meta.path}?${g.stringify(e,{encodeValuesOnly:!0})}`):null},nextPage(){const e=g.parse(window.location.search.substr(1));return e.page=e.page?parseFloat(e.page):1,e.page<this.meta.last_page?(e.page=e.page+1,`${this.meta.path}?${g.stringify(e,{encodeValuesOnly:!0})}`):null}},methods:{trimPageRange(e){if(this.meta.current_page<3||this.meta.current_page>e.length-2){const p=e.slice(0,3);p.push({url:"#"});const n=e.slice(e.length-3);return p.concat(n)}const a=e.slice(0,1);a.push({url:"#"});const o=e.slice(this.meta.current_page-2,this.meta.current_page+1);o.push({url:"#1"});const u=e.slice(e.length-1);return a.concat(o,u)}}},O={class:"bg-white px-4 py-3 flex items-center justify-between sm:px-6"},S={key:0,class:"flex-1 flex justify-between sm:hidden"},B={key:1,class:"sm:hidden text-sm leading-5 text-gray-700 mb-0"},q=t("span",{class:"font-mono"},"¯\\_(ツ)_/¯",-1),F={class:"hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"},I={key:0,class:"text-sm leading-5 text-gray-700 mb-0"},M={class:"font-medium"},A={class:"font-medium"},E={class:"font-medium"},U={key:1,class:"text-sm leading-5 text-gray-700 mb-0"},J=t("span",{class:"font-mono"},"¯\\_(ツ)_/¯",-1),K={key:0,class:"relative z-0 inline-flex shadow-sm"},G=t("svg",{class:"h-5 w-5",fill:"currentColor",viewBox:"0 0 20 20"},[t("path",{"fill-rule":"evenodd",d:"M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z","clip-rule":"evenodd"})],-1),H=t("svg",{class:"h-5 w-5",fill:"currentColor",viewBox:"0 0 20 20"},[t("path",{"fill-rule":"evenodd",d:"M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z","clip-rule":"evenodd"})],-1);function Q(e,a,o,u,p,n){return s(),c("div",O,[o.meta.total>0?(s(),c("div",S,[(s(),h(f(n.prevPage?"inertia-link":"button"),{href:n.prevPage,class:"relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"},{default:d(()=>[i(" Previous ")]),_:1},8,["href"])),(s(),h(f(n.nextPage?"inertia-link":"button"),{href:n.nextPage,class:"ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"},{default:d(()=>[i(" Next ")]),_:1},8,["href"]))])):(s(),c("p",B,[i(" No results found "),q])),t("div",F,[t("div",null,[o.meta.total>0?(s(),c("p",I,[i(" Showing "),t("span",M,m(o.meta.from),1),i(" to "),t("span",A,m(o.meta.to),1),i(" of "),t("span",E,m(o.meta.total),1),i(" results ")])):(s(),c("p",U,[i(" No results found "),J]))]),t("div",null,[n.pageLinks.length>1?(s(),c("nav",K,[(s(),h(f(n.prevPage?"inertia-link":"button"),{href:n.prevPage,class:"relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150","aria-label":"Previous"},{default:d(()=>[G]),_:1},8,["href"])),(s(!0),c(v,null,w(n.pageLinks,l=>(s(),h(f(l.label?"inertia-link":"span"),{key:l.url,href:l.url,class:N(["-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 transition ease-in-out duration-200",{"bg-gray-200 hover:bg-gray-200":l.active,"hover:bg-gray-100 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700":l.label}])},{default:d(()=>[i(m(l.label||"..."),1)]),_:2},1032,["href","class"]))),128)),(s(),h(f(n.nextPage?"inertia-link":"button"),{href:n.nextPage,class:"-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150","aria-label":"Next"},{default:d(()=>[H]),_:1},8,["href"]))])):k("",!0)])])])}const X=y(z,[["render",Q]]),Y=$({props:["modelValue"],emits:["update:modelValue"],methods:{focus(){this.$refs.input.focus()}}}),Z=["value"];function R(e,a,o,u,p,n){return s(),c("input",{ref:"input",class:"border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm",value:e.modelValue,onInput:a[0]||(a[0]=l=>e.$emit("update:modelValue",l.target.value))},null,40,Z)}const ee=y(Y,[["render",R]]),te=$({components:{AppLayout:L,Pagination:X,Tag:j,JetInput:ee},props:{webhooks:{type:Object,default:()=>{}},q:{type:String,default:null}},data(){return{dateConfig:{weekday:"long",year:"numeric",month:"long",day:"numeric"},timeConfig:{hour:"2-digit",minute:"2-digit"},search:null,filteredWebhooks:[]}},mounted(){this.search=this.q,this.filteredWebhooks=this.webhooks},methods:{formatDateTime(e){let a=new Date(e);return a.toLocaleDateString(void 0,this.dateConfig)+" "+a.toLocaleTimeString([],this.timeConfig)},navigateTo(e){window.location.href=route("webhook",[e])},searchWebhooks(){T.get("/search",{params:{q:this.search}}).then(e=>{this.filteredWebhooks=e.data.webhooks}).catch(e=>{})}}}),se=t("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Webhooks ",-1),ae={class:"pt-12"},oe={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},ne={class:"my-4"},re={class:"bg-white overflow-hidden shadow-xl sm:rounded-lg"},ie={class:"min-w-max w-full table-auto"},le=t("thead",null,[t("tr",{class:"bg-gray-200 text-gray-600 uppercase text-sm leading-normal"},[t("th",{class:"py-3 px-6 text-left"}," ID "),t("th",{class:"py-3 px-6 text-center"}," Date "),t("th",{class:"py-3 px-6 text-center"}," Status "),t("th",{class:"py-3 px-6 text-center"}," Delivery ")])],-1),ce={class:"text-gray-600 text-sm font-light"},de=["onClick"],ue={class:"py-3 px-6 text-left whitespace-nowrap"},me={class:"py-3 px-6 text-center"},he={class:"py-3 px-6 text-center"},ge={class:"py-3 px-6 text-center"};function pe(e,a,o,u,p,n){const l=_("jet-label"),P=_("jet-input"),x=_("tag"),V=_("pagination"),C=_("app-layout");return s(),h(C,{title:"Webhooks"},{header:d(()=>[se]),default:d(()=>[t("div",ae,[t("div",oe,[t("div",ne,[b(l,{for:"search",value:"Search"}),b(P,{id:"search",modelValue:e.search,"onUpdate:modelValue":[a[0]||(a[0]=r=>e.search=r),e.searchWebhooks],type:"text",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue","onUpdate:modelValue"])]),t("div",re,[t("table",ie,[le,t("tbody",ce,[(s(!0),c(v,null,w(e.filteredWebhooks.data,r=>(s(),c("tr",{key:r.uuid,class:"border-b border-gray-200 hover:bg-gray-100",onClick:fe=>e.navigateTo(r.uuid)},[t("td",ue,m(r.uuid),1),t("td",me,m(e.formatDateTime(r.created_at)),1),t("td",he,[b(x,{color:r.status_color},{default:d(()=>[i(m(r.status_description),1)]),_:2},1032,["color"])]),t("td",ge,[r.response?(s(),h(x,{key:0,color:r.response_color},{default:d(()=>[i(m(r.response),1)]),_:2},1032,["color"])):k("",!0)])],8,de))),128))])]),b(V,{class:"m-2",links:e.filteredWebhooks.links,meta:e.filteredWebhooks},null,8,["links","meta"])])])])]),_:1})}const ve=y(te,[["render",pe]]);export{ve as default};
