(self.webpackChunk_roots_bud_sage=self.webpackChunk_roots_bud_sage||[]).push([[971],{"./scripts/filters sync recursive .*\\.filter\\..*$":function(t,e,r){var s={"./button.filter.js":"./scripts/filters/button.filter.js"};function n(t){var e=o(t);return r(e)}function o(t){if(!r.o(s,t)){var e=new Error("Cannot find module '"+t+"'");throw e.code="MODULE_NOT_FOUND",e}return s[t]}n.keys=function(){return Object.keys(s)},n.resolve=o,t.exports=n,n.id="./scripts/filters sync recursive .*\\.filter\\..*$"},"./scripts/editor.js":function(t,e,r){"use strict";var s={};r.r(s),r.d(s,{register:function(){return i},unregister:function(){return c}});class n{store={};get(t){return this.store[t]}has(t){return void 0!==this.store[t]}is(t,e){return this.store[t]===e}set(t,e){this.store[t]=e}}window.wp.data;var o=window.wp.hooks;const i=({callback:t,hook:e,name:r})=>{(0,o.hasFilter)(e,r)&&c({hook:e,name:r}),(0,o.addFilter)(e,r,t)},c=({hook:t,name:e})=>(0,o.removeFilter)(t,e);(({accept:t,after:e,api:r,before:s,getContext:o})=>{const i=new n,c=()=>{const t=[];s&&s();const n=o();return n?.keys().forEach((e=>{const s=n(e),o=s.default??s;i.is(e,o)||(i.has(e)&&r.unregister(i.get(e)),r.register(o),t.push(o),i.set(e,o))})),e&&e(t),n},{id:u}=c();t(u,c)})({accept:(t,e)=>{},api:s,getContext:()=>r("./scripts/filters sync recursive .*\\.filter\\..*$")})},"./scripts/filters/button.filter.js":function(t,e,r){"use strict";r.r(e),r.d(e,{callback:function(){return o},hook:function(){return s},name:function(){return n}});const s="blocks.registerBlockType",n="sage/button";function o(t,e){return"core/button"!==e?t:{...t,styles:[{label:"Download",name:"download"}]}}}},function(t){var e;e="./scripts/editor.js",t(t.s=e)}]);