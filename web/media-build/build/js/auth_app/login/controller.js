define(["app","marionette","./view"],function(e,t,n){var r={};return r=t.Controller.extend({initialize:function(){e.subNavbarRegion.close();var t=new n.MainView;this.listenTo(t,"user:login:clicked",function(){e.vent.trigger("show:tools"),e.Routes.navigate("#dashboard",{trigger:!0})}),e.mainRegion.show(t)}}),r});