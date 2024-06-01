/*
 Highstock JS v10.2.1 (2022-08-29)

 Indicator series type for Highcharts Stock

 (c) 2010-2021 Pawe Dalek

 License: www.highcharts.com/license
*/
(function(b){"object"===typeof module&&module.exports?(b["default"]=b,module.exports=b):"function"===typeof define&&define.amd?define("highcharts/indicators/volume-by-price",["highcharts","highcharts/modules/stock"],function(n){b(n);b.Highcharts=n;return b}):b("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(b){function n(b,l,y,e){b.hasOwnProperty(l)||(b[l]=e.apply(null,y),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:l,module:b[l]}})))}
b=b?b._modules:{};n(b,"Stock/Indicators/VBP/VBPPoint.js",[b["Core/Series/SeriesRegistry.js"]],function(b){var l=this&&this.__extends||function(){var b=function(e,a){b=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(b,a){b.__proto__=a}||function(b,a){for(var e in a)a.hasOwnProperty(e)&&(b[e]=a[e])};return b(e,a)};return function(e,a){function l(){this.constructor=e}b(e,a);e.prototype=null===a?Object.create(a):(l.prototype=a.prototype,new l)}}();return function(b){function e(){return null!==
b&&b.apply(this,arguments)||this}l(e,b);e.prototype.destroy=function(){this.negativeGraphic&&(this.negativeGraphic=this.negativeGraphic.destroy());return b.prototype.destroy.apply(this,arguments)};return e}(b.seriesTypes.sma.prototype.pointClass)});n(b,"Stock/Indicators/VBP/VBPIndicator.js",[b["Stock/Indicators/VBP/VBPPoint.js"],b["Core/Animation/AnimationUtilities.js"],b["Core/Globals.js"],b["Core/Series/SeriesRegistry.js"],b["Core/Utilities.js"],b["Core/Chart/StockChart.js"]],function(b,l,n,e,a,
H){var y=this&&this.__extends||function(){var b=function(a,c){b=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(c,b){c.__proto__=b}||function(c,b){for(var d in b)b.hasOwnProperty(d)&&(c[d]=b[d])};return b(a,c)};return function(a,c){function u(){this.constructor=a}b(a,c);a.prototype=null===c?Object.create(c):(u.prototype=c.prototype,new u)}}(),I=l.animObject;l=n.noop;var C=e.seriesTypes.sma,x=e.seriesTypes.column.prototype,z=a.addEvent,D=a.arrayMax,J=a.arrayMin,A=a.correctFloat,E=a.defined,
B=a.error,F=a.extend,K=a.isArray,L=a.merge,v=Math.abs;a=function(b){function a(){var c=null!==b&&b.apply(this,arguments)||this;c.data=void 0;c.negWidths=void 0;c.options=void 0;c.points=void 0;c.posWidths=void 0;c.priceZones=void 0;c.rangeStep=void 0;c.volumeDataArray=void 0;c.zoneStarts=void 0;c.zoneLinesSVG=void 0;return c}y(a,b);a.prototype.init=function(c){var b=this,a,d,h;n.seriesTypes.sma.prototype.init.apply(b,arguments);var r=z(H,"afterLinkSeries",function(){b.options&&(a=b.options.params,
d=b.linkedParent,h=c.get(a.volumeSeriesID),b.addCustomEvents(d,h));r()},{order:1});return b};a.prototype.addCustomEvents=function(c,b){function a(){d.chart.redraw();d.setData([]);d.zoneStarts=[];d.zoneLinesSVG&&(d.zoneLinesSVG=d.zoneLinesSVG.destroy())}var d=this;d.dataEventsToUnbind.push(z(c,"remove",function(){a()}));b&&d.dataEventsToUnbind.push(z(b,"remove",function(){a()}));return d};a.prototype.animate=function(b){var c=this,a=c.chart.inverted,d=c.group,h={};!b&&d&&(b=a?c.yAxis.top:c.xAxis.left,
a?(d["forceAnimate:translateY"]=!0,h.translateY=b):(d["forceAnimate:translateX"]=!0,h.translateX=b),d.animate(h,F(I(c.options.animation),{step:function(b,a){c.group.attr({scaleX:Math.max(.001,a.pos)})}})))};a.prototype.drawPoints=function(){this.options.volumeDivision.enabled&&(this.posNegVolume(!0,!0),x.drawPoints.apply(this,arguments),this.posNegVolume(!1,!1));x.drawPoints.apply(this,arguments)};a.prototype.posNegVolume=function(b,a){var c=a?["positive","negative"]:["negative","positive"],d=this.options.volumeDivision,
h=this.points.length,r=[],f=[],k=0,m;b?(this.posWidths=r,this.negWidths=f):(r=this.posWidths,f=this.negWidths);for(;k<h;k++){var g=this.points[k];g[c[0]+"Graphic"]=g.graphic;g.graphic=g[c[1]+"Graphic"];if(b){var u=g.shapeArgs.width;var e=this.priceZones[k];(m=e.wholeVolumeData)?(r.push(u/m*e.positiveVolumeData),f.push(u/m*e.negativeVolumeData)):(r.push(0),f.push(0))}g.color=a?d.styles.positiveColor:d.styles.negativeColor;g.shapeArgs.width=a?this.posWidths[k]:this.negWidths[k];g.shapeArgs.x=a?g.shapeArgs.x:
this.posWidths[k]}};a.prototype.translate=function(){var b=this,a=b.options,e=b.chart,d=b.yAxis,h=d.min,r=b.options.zoneLines,f=b.priceZones,k=0,m,g,G;x.translate.apply(b);var q=b.points;if(q.length){var l=.5>a.pointPadding?a.pointPadding:.1;a=b.volumeDataArray;var t=D(a);var p=e.plotWidth/2;var M=e.plotTop;var w=v(d.toPixels(h)-d.toPixels(h+b.rangeStep));var n=v(d.toPixels(h)-d.toPixels(h+b.rangeStep));l&&(h=v(w*(1-2*l)),k=v((w-h)/2),w=v(h));q.forEach(function(a,c){g=a.barX=a.plotX=0;G=a.plotY=d.toPixels(f[c].start)-
M-(d.reversed?w-n:w)-k;m=A(p*f[c].wholeVolumeData/t);a.pointWidth=m;a.shapeArgs=b.crispCol.apply(b,[g,G,m,w]);a.volumeNeg=f[c].negativeVolumeData;a.volumePos=f[c].positiveVolumeData;a.volumeAll=f[c].wholeVolumeData});r.enabled&&b.drawZones(e,d,b.zoneStarts,r.styles)}};a.prototype.getValues=function(b,a){var c=b.processedXData,d=b.processedYData,h=this.chart,r=a.ranges,f=[],k=[],e=[],g;if(b.chart)if(g=h.get(a.volumeSeriesID))if((a=K(d[0]))&&4!==d[0].length)B("Type of "+b.name+" series is different than line, OHLC or candlestick.",
!0,h);else return(this.priceZones=this.specifyZones(a,c,d,r,g)).forEach(function(b,a){f.push([b.x,b.end]);k.push(f[a][0]);e.push(f[a][1])}),{values:f,xData:k,yData:e};else B("Series "+a.volumeSeriesID+" not found! Check `volumeSeriesID`.",!0,h);else B("Base series not found! In case it has been removed, add a new one.",!0,h)};a.prototype.specifyZones=function(b,a,e,d,h){if(b){var c=e.length;for(var f=e[0][3],k=f,m=1,g;m<c;m++)g=e[m][3],g<f&&(f=g),g>k&&(k=g);c={min:f,max:k}}else c=!1;c=(f=c)?f.min:
J(e);g=f?f.max:D(e);f=this.zoneStarts=[];k=[];var l=0;m=1;var q=this.linkedParent;!this.options.compareToMain&&q.dataModify&&(c=q.dataModify.modifyValue(c),g=q.dataModify.modifyValue(g));if(!E(c)||!E(g))return this.points.length&&(this.setData([]),this.zoneStarts=[],this.zoneLinesSVG&&(this.zoneLinesSVG=this.zoneLinesSVG.destroy())),[];q=this.rangeStep=A(g-c)/d;for(f.push(c);l<d-1;l++)f.push(A(f[l]+q));f.push(g);for(d=f.length;m<d;m++)k.push({index:m-1,x:a[0],start:f[m-1],end:f[m]});return this.volumePerZone(b,
k,h,a,e)};a.prototype.volumePerZone=function(b,a,e,d,h){var c=this,f=e.processedXData,k=e.processedYData,l=a.length-1,g=h.length;e=k.length;var n,q,u,t,p;v(g-e)&&(d[0]!==f[0]&&k.unshift(0),d[g-1]!==f[e-1]&&k.push(0));c.volumeDataArray=[];a.forEach(function(a){a.wholeVolumeData=0;a.positiveVolumeData=0;for(p=a.negativeVolumeData=0;p<g;p++){u=q=!1;t=b?h[p][3]:h[p];n=p?b?h[p-1][3]:h[p-1]:t;var d=c.linkedParent;!c.options.compareToMain&&d.dataModify&&(t=d.dataModify.modifyValue(t),n=d.dataModify.modifyValue(n));
t<=a.start&&0===a.index&&(q=!0);t>=a.end&&a.index===l&&(u=!0);(t>a.start||q)&&(t<a.end||u)&&(a.wholeVolumeData+=k[p],n>t?a.negativeVolumeData+=k[p]:a.positiveVolumeData+=k[p])}c.volumeDataArray.push(a.wholeVolumeData)});return a};a.prototype.drawZones=function(a,b,e,d){var c=a.renderer,l=this.zoneLinesSVG,f=[],k=a.plotWidth,m=a.plotTop,g;e.forEach(function(c){g=b.toPixels(c)-m;f=f.concat(a.renderer.crispLine([["M",0,g],["L",k,g]],d.lineWidth))});l?l.animate({d:f}):l=this.zoneLinesSVG=c.path(f).attr({"stroke-width":d.lineWidth,
stroke:d.color,dashstyle:d.dashStyle,zIndex:this.group.zIndex+.1}).add(this.group)};a.defaultOptions=L(C.defaultOptions,{params:{index:void 0,period:void 0,ranges:12,volumeSeriesID:"volume"},zoneLines:{enabled:!0,styles:{color:"#0A9AC9",dashStyle:"LongDash",lineWidth:1}},volumeDivision:{enabled:!0,styles:{positiveColor:"rgba(144, 237, 125, 0.8)",negativeColor:"rgba(244, 91, 91, 0.8)"}},animationLimit:1E3,enableMouseTracking:!1,pointPadding:0,zIndex:-1,crisp:!0,dataGrouping:{enabled:!1},dataLabels:{allowOverlap:!0,
enabled:!0,format:"P: {point.volumePos:.2f} | N: {point.volumeNeg:.2f}",padding:0,style:{fontSize:"7px"},verticalAlign:"top"}});return a}(C);F(a.prototype,{nameBase:"Volume by Price",nameComponents:["ranges"],calculateOn:{chart:"render",xAxis:"afterSetExtremes"},pointClass:b,markerAttribs:l,drawGraph:l,getColumnMetrics:x.getColumnMetrics,crispCol:x.crispCol});e.registerSeriesType("vbp",a);"";return a});n(b,"masters/indicators/volume-by-price.src.js",[],function(){})});
//# sourceMappingURL=volume-by-price.js.map