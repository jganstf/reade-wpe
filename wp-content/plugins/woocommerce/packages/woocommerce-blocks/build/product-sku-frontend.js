(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[78,75],{22:function(t,e,n){"use strict";n.d(e,"a",(function(){return o})),n.d(e,"b",(function(){return r}));const o=t=>!(t=>null===t)(t)&&t instanceof Object&&t.constructor===Object;function r(t,e){return o(t)&&e in t}},278:function(t,e,n){"use strict";n.d(e,"a",(function(){return o}));var o=function(){return(o=Object.assign||function(t){for(var e,n=1,o=arguments.length;n<o;n++)for(var r in e=arguments[n])Object.prototype.hasOwnProperty.call(e,r)&&(t[r]=e[r]);return t}).apply(this,arguments)};Object.create,Object.create},279:function(t,e,n){"use strict";function o(t){return t.toLowerCase()}n.d(e,"a",(function(){return l}));var r=[/([a-z0-9])([A-Z])/g,/([A-Z])([A-Z][a-z])/g],c=/[^A-Z0-9]+/gi;function l(t,e){void 0===e&&(e={});for(var n=e.splitRegexp,l=void 0===n?r:n,a=e.stripRegexp,i=void 0===a?c:a,u=e.transform,d=void 0===u?o:u,f=e.delimiter,b=void 0===f?" ":f,v=s(s(t,l,"$1\0$2"),i,"\0"),m=0,p=v.length;"\0"===v.charAt(m);)m++;for(;"\0"===v.charAt(p-1);)p--;return v.slice(m,p).split("\0").map(d).join(b)}function s(t,e,n){return e instanceof RegExp?t.replace(e,n):e.reduce((function(t,e){return t.replace(e,n)}),t)}},284:function(t,e,n){"use strict";n.d(e,"a",(function(){return c}));var o=n(278),r=n(279);function c(t,e){return void 0===e&&(e={}),function(t,e){return void 0===e&&(e={}),Object(r.a)(t,Object(o.a)({delimiter:"."},e))}(t,Object(o.a)({delimiter:"-"},e))}},286:function(t,e,n){"use strict";n.d(e,"a",(function(){return d}));var o=n(5),r=n.n(o),c=n(22),l=n(28),s=n(284),a=n(129);function i(){let t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};const e={};return Object(a.getCSSRules)(t,{selector:""}).forEach(t=>{e[t.key]=t.value}),e}function u(t,e){return t&&e?`has-${Object(s.a)(e)}-${t}`:""}const d=t=>{const e=(t=>{const e=Object(c.a)(t)?t:{style:{}};let n=e.style;return Object(l.a)(n)&&(n=JSON.parse(n)||{}),Object(c.a)(n)||(n={}),{...e,style:n}})(t),n=function(t){var e,n,o,l,s,a,d;const{backgroundColor:f,textColor:b,gradient:v,style:m}=t,p=u("background-color",f),y=u("color",b),g=function(t){if(t)return`has-${t}-gradient-background`}(v),O=g||(null==m||null===(e=m.color)||void 0===e?void 0:e.gradient);return{className:r()(y,g,{[p]:!O&&!!p,"has-text-color":b||(null==m||null===(n=m.color)||void 0===n?void 0:n.text),"has-background":f||(null==m||null===(o=m.color)||void 0===o?void 0:o.background)||v||(null==m||null===(l=m.color)||void 0===l?void 0:l.gradient),"has-link-color":Object(c.a)(null==m||null===(s=m.elements)||void 0===s?void 0:s.link)?null==m||null===(a=m.elements)||void 0===a||null===(d=a.link)||void 0===d?void 0:d.color:void 0}),style:i({color:(null==m?void 0:m.color)||{}})}}(e),o=function(t){var e;const n=(null===(e=t.style)||void 0===e?void 0:e.border)||{};return{className:function(t){var e;const{borderColor:n,style:o}=t,c=n?u("border-color",n):"";return r()({"has-border-color":n||(null==o||null===(e=o.border)||void 0===e?void 0:e.color),borderColorClass:c})}(t),style:i({border:n})}}(e),s=function(t){var e;return{className:void 0,style:i({spacing:(null===(e=t.style)||void 0===e?void 0:e.spacing)||{}})}}(e),a=(t=>{const e=Object(c.a)(t.style.typography)?t.style.typography:{},n=Object(l.a)(e.fontFamily)?e.fontFamily:"";return{className:t.fontFamily?`has-${t.fontFamily}-font-family`:n,style:{fontSize:t.fontSize?`var(--wp--preset--font-size--${t.fontSize})`:e.fontSize,fontStyle:e.fontStyle,fontWeight:e.fontWeight,letterSpacing:e.letterSpacing,lineHeight:e.lineHeight,textDecoration:e.textDecoration,textTransform:e.textTransform}}})(e);return{className:r()(a.className,n.className,o.className,s.className),style:{...a.style,...n.style,...o.style,...s.style}}}},423:function(t,e){},466:function(t,e,n){"use strict";n.r(e);var o=n(13),r=n.n(o),c=n(0),l=n(1),s=n(5),a=n.n(s),i=n(60),u=n(144),d=n(286);n(423);const f=t=>{let{parentClassName:e,sku:n,className:o,style:r}=t;return Object(c.createElement)("div",{className:a()(o,{[e+"__product-sku"]:e}),style:r},Object(l.__)("SKU:","woocommerce")," ",Object(c.createElement)("strong",null,n))};e.default=Object(u.withProductDataContext)(t=>{const{className:e}=t,n=Object(d.a)(t),{parentClassName:o}=Object(i.useInnerBlockLayoutContext)(),{product:l}=Object(i.useProductDataContext)(),s=l.sku;return t.isDescendentOfSingleProductTemplate?Object(c.createElement)(f,{parentClassName:o,className:e,sku:"Product SKU"}):s?Object(c.createElement)(f,r()({className:e,parentClassName:o,sku:s},t.isDescendantOfAllProducts&&{className:a()(e,"wc-block-components-product-sku wp-block-woocommerce-product-sku",n.className),style:{...n.style}})):null})}}]);