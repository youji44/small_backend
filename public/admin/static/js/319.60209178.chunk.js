"use strict";(self.webpackChunkcities=self.webpackChunkcities||[]).push([[319],{9242:function(e,n,t){t.r(n),t.d(n,{default:function(){return X}});var r=t(4165),i=t(5861),o=t(9439),s=t(2791),a=t(6871),l=(t(700),t(1440)),d=t(330),c=t(9529),u=t(2414),f=t(2864),p=t(50),h=t(3621),v=t(5546),Z=t(7295),x=t(586),j=t(5485),g=t(7495),m=t(3099),y=t(6755),b=t(7309),w=t(7706),k=t(2649),S=t(2468),C=t(1413),Y=t(3433),I=t(5567),N=t(4571),A=t(3194),D=t(2622),T=t(2862),z=t(184),H=j.Z.Text,O=function(e){var n=e.visible,t=e.viewData,r=e.onClose;return(0,z.jsx)("div",{children:(0,z.jsx)(T.Z,{title:null===t||void 0===t?void 0:t.name,centered:!0,width:700,visible:n,onOk:r,onCancel:r,footer:null,children:(0,z.jsxs)(m.Z,{direction:"vertical",children:[(0,z.jsxs)(m.Z,{children:[(0,z.jsx)(H,{strong:!0,children:"Time:"}),(0,z.jsx)(H,{children:null===t||void 0===t?void 0:t.dateTime})]}),(0,z.jsxs)(m.Z,{children:[(0,z.jsx)(H,{strong:!0,children:"IP Address:"}),(0,z.jsx)(H,{children:null===t||void 0===t?void 0:t.ipAddress})]}),(0,z.jsxs)(m.Z,{children:[(0,z.jsx)(H,{strong:!0,children:"Browser:"}),(0,z.jsx)(H,{children:null===t||void 0===t?void 0:t.browsersDetails})]})]})})})},B=t(9434),J=t(8281),P=t.n(J),R=t(2426),E=t.n(R),M=function(){var e=(0,i.Z)((0,r.Z)().mark((function e(n){var t,i,o,s;return(0,r.Z)().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t=localStorage.getItem("token"),i=JSON.parse(t),(o=new Headers).append("Authorization","Bearer ".concat(i)),o.append("Content-Type","application/json"),s={method:"post",headers:o,redirect:"follow",body:JSON.stringify(n)},e.abrupt("return",fetch(l.HJ+"/updateStatus",s).then((function(e){return e.json()})).then((function(e){if(console.log("result:",e),null!==e&&void 0!==e&&e.success)return(0,S.bZ)("success","user request status updated"),1;throw"error"})).catch((function(e){return(0,S.bZ)("error","error while updating user request status"),0})));case 7:case"end":return e.stop()}}),e)})));return function(n){return e.apply(this,arguments)}}(),q=function(){var e=(0,i.Z)((0,r.Z)().mark((function e(n){var t,i,o,s;return(0,r.Z)().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t=localStorage.getItem("token"),i=JSON.parse(t),(o=new Headers).append("Authorization","Bearer ".concat(i)),o.append("Content-Type","application/json"),s={method:"delete",headers:o,redirect:"follow"},e.abrupt("return",fetch(l.HJ+"/deleteUserDetail/"+n,s).then((function(e){return e.json()})).then((function(e){if(console.log("result:",e),null!==e&&void 0!==e&&e.success)return(0,S.bZ)("success","user deleted successfully"),1;throw"error"})).catch((function(e){return(0,S.bZ)("error","error while deleting user"),0})));case 7:case"end":return e.stop()}}),e)})));return function(n){return e.apply(this,arguments)}}(),K=function(){var e=(0,i.Z)((0,r.Z)().mark((function e(){var n,t,i,o;return(0,r.Z)().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n=localStorage.getItem("token"),t=JSON.parse(n),(i=new Headers).append("Authorization","Bearer ".concat(t)),o={method:"get",headers:i,redirect:"follow"},e.abrupt("return",fetch(l.HJ+"/unreadNotification",o).then((function(e){return e.json()})).then((function(e){if(null!==e&&void 0!==e&&e.success)return null===e||void 0===e?void 0:e.unreadNotificaitonCount;throw"error"})).catch((function(e){return(0,S.bZ)("error","error while updating user request status"),0})));case 6:case"end":return e.stop()}}),e)})));return function(){return e.apply(this,arguments)}}(),F=t(5995),L=t.p+"static/media/sound.cf6feaa3e974ae497f66.mp3",U=function(){var e=(0,B.I0)(),n=(0,F.Z)(L),t=(0,o.Z)(n,1)[0],a=(0,l.KB)((function(e){return null===e||void 0===e?void 0:e.dashboard})),d=a.data,c=a.loading,u=(0,s.useState)([]),f=(0,o.Z)(u,2),p=f[0],h=f[1],v=(0,s.useState)([]),Z=(0,o.Z)(v,2),x=Z[0],j=Z[1],g=(0,s.useState)(!1),y=(0,o.Z)(g,2),b=y[0],w=y[1],k=(0,s.useState)(null),T=(0,o.Z)(k,2),H=T[0],J=(T[1],(0,s.useState)(!1)),R=(0,o.Z)(J,2),K=R[0],U=R[1];console.log("data:",d);var V=(0,s.useState)(!1),W=(0,o.Z)(V,2);W[0],W[1];(0,s.useEffect)((function(){e(null===l.dY||void 0===l.dY?void 0:l.dY.loadDashboard()),new(P())("9de74d5973e05bb9941d",{cluster:"ap2"}).subscribe("newProject").bind("justTest",(function(n){(0,S.bZ)("success",JSON.stringify(null===n||void 0===n?void 0:n.name)+" store his details"),e(null===l.dY||void 0===l.dY?void 0:l.dY.loadDashboard())}))}),[]),(0,s.useEffect)((function(){d&&G()}),[d]),(0,s.useEffect)((function(){h((0,Y.Z)(d)),j(new Array(null===d||void 0===d?void 0:d.length).fill([!1,!1]))}),[d]);var G=function(){t()},Q=function(){var n=(0,i.Z)((0,r.Z)().mark((function n(t){return(0,r.Z)().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,q(t);case 2:e(null===l.dY||void 0===l.dY?void 0:l.dY.dashboardResponse((0,Y.Z)(null===d||void 0===d?void 0:d.filter((function(e){return(null===e||void 0===e?void 0:e.id)!==t}))))),j(null===x||void 0===x?void 0:x.fill([!1,!1]));case 4:case"end":return n.stop()}}),n)})));return function(e){return n.apply(this,arguments)}}(),X=function(){var n=(0,i.Z)((0,r.Z)().mark((function n(t,i,o){return(0,r.Z)().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return U(!0),e(null===l.dY||void 0===l.dY?void 0:l.dY.dashboardResponse(null===d||void 0===d?void 0:d.map((function(e){return(null===e||void 0===e?void 0:e.id)===o?(0,C.Z)((0,C.Z)({},e),{},{enable:t}):e})))),n.next=4,M({id:o,enable:t});case 4:U(!1);case 5:case"end":return n.stop()}}),n)})));return function(e,t,r){return n.apply(this,arguments)}}(),$=[{title:"Name",dataIndex:"name"},{title:"Date Time",dataIndex:"dateTime",render:function(e){return E()(e).format("MMMM Do YY, h:mm")}},{title:"IP Address",dataIndex:"ipAddress"},{title:"ISP",dataIndex:"isp"},{title:"Browser",dataIndex:"browsersDetails"},{title:"Request Status",dataIndex:"enable",render:function(e,n,t){return(0,z.jsxs)(I.Z,{style:{width:"100px"},value:e,disabled:K,onChange:function(e){X(e,t,null===n||void 0===n?void 0:n.id)},children:[(0,z.jsx)(I.Z.Option,{value:"1",children:"Pending"}),(0,z.jsx)(I.Z.Option,{value:"2",children:"Approve"}),(0,z.jsx)(I.Z.Option,{value:"3",children:"Cancel"})]})}},{title:"Action",dataIndex:"action",render:function(e,n,t){return(0,z.jsx)(m.Z,{children:(0,z.jsx)(N.Z,{title:"Remove user?",visible:x[t][0],onConfirm:function(){j(null===x||void 0===x?void 0:x.map((function(e,n){return n===t?[!0,!0]:e}))),Q(null===n||void 0===n?void 0:n.id)},okButtonProps:{loading:x[t][1]},onCancel:function(){j(null===x||void 0===x?void 0:x.map((function(e){return[!1,!1]})))},children:(0,z.jsx)(S.Kk,{noToolTip:!0,icon:(0,z.jsx)(D.Z,{}),danger:!0,onClick:function(){j(null===x||void 0===x?void 0:x.map((function(e,n){return n===t?[!0,!1]:[!1,!1]})))}})})})}}];return(0,z.jsxs)(z.Fragment,{children:[(0,z.jsx)(S.YV,{name:"Dashboard"}),(0,z.jsx)(A.Z,{columns:$,dataSource:p,loading:c,pagination:!1}),(0,z.jsx)(O,{visible:b,viewData:H,onClose:function(){w(!1)}})]})},V=x.Z.Header,W=x.Z.Sider,G=x.Z.Content,Q=j.Z.Title;var X=function(){var e=(0,l.dN)(),n=(0,a.s0)(),t=(0,F.Z)(L),j=((0,o.Z)(t,1)[0],(0,s.useState)(!1)),S=(0,o.Z)(j,2),C=S[0],Y=S[1],I=(0,s.useState)(0),N=(0,o.Z)(I,2),A=(N[0],N[1]),D=(0,s.useState)([]),T=(0,o.Z)(D,2),H=T[0],O=T[1];(0,s.useEffect)((function(){var e,t,r,i,o,s=[];s.push((e="Dashboard",t="1",r=(0,z.jsx)(d.Z,{}),{key:t,icon:r,onClick:function(){n("/",{replace:!0})},children:i,label:e,type:o})),O([].concat(s)),B(),console.log("sound:",L)}),[]);var B=function(){var e=(0,i.Z)((0,r.Z)().mark((function e(){var n;return(0,r.Z)().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,K();case 2:n=e.sent,A(n);case 4:case"end":return e.stop()}}),e)})));return function(){return e.apply(this,arguments)}}(),J=(0,z.jsx)(g.Z,{style:{borderRadius:"3px",transform:"translateY(10px)"},items:[{label:(0,z.jsxs)(m.Z,{style:{fontSize:"14px"},children:[(0,z.jsx)(c.Z,{})," ",(0,z.jsx)("a",{href:"/",style:{color:"gray"},children:"Profile"})]}),key:"0"},{label:(0,z.jsxs)(m.Z,{style:{fontSize:"14px"},children:[(0,z.jsx)(u.Z,{})," ",(0,z.jsx)("span",{style:{color:"gray"},children:"Account Setting"})]}),key:"1"},{type:"divider"},{label:(0,z.jsxs)(m.Z,{style:{fontSize:"14px"},onClick:function(){localStorage.removeItem("token"),localStorage.removeItem("userRole"),e(null===l.dY||void 0===l.dY?void 0:l.dY.loginClear()),window.location.href="/"},children:[(0,z.jsx)(f.Z,{})," ",(0,z.jsx)("a",{href:"/",style:{color:"red"},children:"Logout"})]}),key:"3"}]});return g.Z,m.Z,m.Z,m.Z,y.Z,m.Z,m.Z,p.Z,m.Z,y.Z,m.Z,m.Z,p.Z,m.Z,y.Z,m.Z,m.Z,p.Z,m.Z,b.Z,(0,z.jsxs)(x.Z,{style:{height:"100vh"},children:[(0,z.jsxs)(W,{trigger:null,collapsible:!0,collapsed:C,style:{height:"100vh",overflowY:"auto"},children:[(0,z.jsx)("div",{className:"logo",style:{display:"flex",justifyContent:"center"},children:(0,z.jsx)(y.Z,{width:"80%",height:"auto",src:"./assets/images/sidebar-logo.png"})}),(0,z.jsx)(g.Z,{defaultSelectedKeys:["1"],mode:"inline",theme:"dark",inlineCollapsed:C,items:H})]}),(0,z.jsxs)(x.Z,{className:"site-layout",children:[(0,z.jsx)(V,{className:"site-layout-background",style:{padding:0,display:"flex",justifyContent:"center"},children:(0,z.jsxs)("div",{style:{width:"95%",display:"flex",justifyContent:"space-between"},children:[s.createElement(C?h.Z:v.Z,{className:"trigger",onClick:function(){return Y(!C)}}),(0,z.jsx)(m.Z,{size:30,children:(0,z.jsx)(w.Z,{overlay:J,trigger:["click"],style:{padding:"15px",left:"1286px !important",top:"50px !important"},children:(0,z.jsx)("a",{onClick:function(e){return e.preventDefault()},children:(0,z.jsxs)(m.Z,{size:10,children:[(0,z.jsx)(k.C,{icon:(0,z.jsx)(c.Z,{})}),(0,z.jsx)(Q,{level:5,style:{fontSize:"14px",marginBottom:"0px",color:"rgba(0, 0, 0, 0.45)"},children:"Mr Hacker"}),(0,z.jsx)(Z.Z,{style:{color:"rgba(0, 0, 0, 0.45)"}})]})})})})]})}),(0,z.jsx)(G,{className:"site-layout-background",style:{margin:"24px 16px",padding:24,minHeight:280,overflowY:"auto"},children:(0,z.jsx)(a.Z5,{children:(0,z.jsx)(a.AW,{path:"/",element:(0,z.jsx)(U,{})})})})]})]})}}}]);
//# sourceMappingURL=319.60209178.chunk.js.map