import{u as m,d,o as c,e as u,b as a,h as e,w as r,F as p,H as f,a as o,n as _,g as w,k as b}from"./app-023ef01f.js";import{A as g}from"./AuthenticationCard-700ef475.js";import{_ as h}from"./AuthenticationCardLogo-a5589f04.js";import{_ as x,a as v}from"./TextInput-1bf7962c.js";import{_ as y}from"./InputLabel-2455bd3f.js";import{_ as V}from"./PrimaryButton-cac58240.js";import"./_plugin-vue_export-helper-c27b6911.js";const k=o("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),C=["onSubmit"],$={class:"flex justify-end mt-4"},j={__name:"ConfirmPassword",setup(F){const s=m({password:""}),t=d(null),n=()=>{s.post(route("password.confirm"),{onFinish:()=>{s.reset(),t.value.focus()}})};return(A,i)=>(c(),u(p,null,[a(e(f),{title:"Secure Area"}),a(g,null,{logo:r(()=>[a(h)]),default:r(()=>[k,o("form",{onSubmit:b(n,["prevent"])},[o("div",null,[a(y,{for:"password",value:"Password"}),a(x,{id:"password",ref_key:"passwordInput",ref:t,modelValue:e(s).password,"onUpdate:modelValue":i[0]||(i[0]=l=>e(s).password=l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),a(v,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),o("div",$,[a(V,{class:_(["ml-4",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:r(()=>[w(" Confirm ")]),_:1},8,["class","disabled"])])],40,C)]),_:1})],64))}};export{j as default};
