(self.webpackChunk=self.webpackChunk||[]).push([[590],{8839:(t,n,e)=>{"use strict";e(4436);e(9755)("#toc").toc({content:".news_detail .description",headings:"h1,h2,h3,h4"})},4436:(t,n,e)=>{!function(t){"use strict";var n=function(n){return this.each((function(){var e,i,a=t(this),c=a.data(),o=[a],h=this.tagName,s=0;e=t.extend({content:"body",headings:"h1,h2,h3"},{content:c.toc||void 0,headings:c.tocHeadings||void 0},n),i=e.headings.split(","),t(e.content).find(e.headings).attr("id",(function(n,e){return e||function(t){0===t.length&&(t="?");for(var n=t.replace(/\s+/g,"_"),e="",i=1;null!==document.getElementById(n+e);)e="_"+i++;return n+e}(t(this).text())})).each((function(){var n=t(this),e=t.map(i,(function(t,e){return n.is(t)?e:void 0}))[0];if(e>s){var a=o[0].children("li:last")[0];a&&o.unshift(t("<"+h+"/>").appendTo(a))}else o.splice(0,Math.min(s-e,Math.max(o.length-1,0)));t("<li/>").appendTo(o[0]).append(t("<a/>").text(n.text()).attr("href","#"+n.attr("id"))),s=e}))}))},e=t.fn.toc;t.fn.toc=n,t.fn.toc.noConflict=function(){return t.fn.toc=e,this},t((function(){n.call(t("[data-toc]"))}))}(e(9755))}},t=>{t.O(0,[226],(()=>{return n=8839,t(t.s=n);var n}));t.O()}]);
//# sourceMappingURL=detail.js.map