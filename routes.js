(function(name, definition) {
    if (typeof module != 'undefined') module.exports = definition();
    else if (typeof define == 'function' && typeof define.amd == 'object') define(definition);
    else this[name] = definition();
}('Router', function() {
  return {
    routes: [{"uri":"dashboard","name":"indexDashboard"},{"uri":"dashboard\/logout","name":"logout"},{"uri":"dashboard\/access-denied","name":"accessDenied"},{"uri":"dashboard\/users","name":"listUsers"},{"uri":"dashboard\/user\/{userId}","name":"deleteUsers"},{"uri":"dashboard\/user\/new","name":"newUserPost"},{"uri":"dashboard\/user\/new","name":"newUser"},{"uri":"dashboard\/user\/{userId}","name":"showUser"},{"uri":"dashboard\/user\/{userId}","name":"putUser"},{"uri":"dashboard\/user\/{userId}\/activate","name":"putActivateUser"},{"uri":"dashboard\/groups","name":"listGroups"},{"uri":"dashboard\/group\/new","name":"newGroupPost"},{"uri":"dashboard\/group\/new","name":"newGroup"},{"uri":"dashboard\/group\/{groupId}","name":"deleteGroup"},{"uri":"dashboard\/group\/{groupId}","name":"showGroup"},{"uri":"dashboard\/group\/{groupId}","name":"putGroup"},{"uri":"dashboard\/group\/{groupId}\/user\/{userId}","name":"deleteUserGroup"},{"uri":"dashboard\/group\/{groupId}\/user\/{userId}","name":"addUserGroup"},{"uri":"dashboard\/permissions","name":"listPermissions"},{"uri":"dashboard\/permission\/{permissionId}","name":"deletePermission"},{"uri":"dashboard\/permission\/new","name":"newPermission"},{"uri":"dashboard\/permission\/new","name":"newPermissionPost"},{"uri":"dashboard\/permission\/{permissionId}","name":"showPermission"},{"uri":"dashboard\/permission\/{permissionId}","name":"putPermission"},{"uri":"dashboard\/login","name":"getLogin"},{"uri":"dashboard\/login","name":"postLogin"},{"uri":"dashboard\/user\/activation\/{activationCode}","name":"getActivate"},{"uri":"\/","name":"index"},{"uri":"login","name":"sessions.login"},{"uri":"login","name":"sessions.store"},{"uri":"logout","name":"sessions.logout"},{"uri":"register","name":"register.index"},{"uri":"register","name":"register.store"},{"uri":"ask","name":"question.create"},{"uri":"ask","name":"question.store"},{"uri":"qa","name":"question.index"},{"uri":"question\/{id}","name":"question.show"},{"uri":"question\/edit\/{id}","name":"question.edit"},{"uri":"question\/{id}","name":"question.update"},{"uri":"question\/delete\/{id}","name":"question.delete"},{"uri":"question\/lock\/{id}","name":"question.lock"},{"uri":"question\/unlock\/{id}","name":"question.unlock"},{"uri":"question\/tagged\/{tag}","name":"question.tagged"},{"uri":"question\/tags","name":"question.tags"},{"uri":"qa\/unanswered","name":"question.unanswered"},{"uri":"question\/{id}","name":"answer.store"},{"uri":"answer\/update\/{id}","name":"answer.update"},{"uri":"answer\/choose\/{id}","name":"choose.best.answer"},{"uri":"answer\/delete\/{id}","name":"answer.delete"},{"uri":"answer\/edit\/{id}","name":"answer.edit"},{"uri":"question\/like\/{id}","name":"question.like"},{"uri":"question\/unlike\/{id}","name":"question.unlike"},{"uri":"answer\/like\/{id}","name":"answer.like"},{"uri":"answer\/unlike\/{id}","name":"answer.unlike"},{"uri":"user\/{id}","name":"user.show"},{"uri":"password\/reset","name":"password.remind"},{"uri":"password\/reset","name":"password.request"},{"uri":"password\/reset\/{token}","name":"password.reset"},{"uri":"password\/reset\/{token}","name":"password.update"},{"uri":"epps","name":"epps.index"},{"uri":"epps\/create","name":"epps.create"},{"uri":"epps","name":"epps.store"},{"uri":"epps\/{epps}","name":"epps.show"},{"uri":"epps\/{epps}\/edit","name":"epps.edit"},{"uri":"epps\/{epps}","name":"epps.update"},{"uri":"epps\/{epps}","name":"epps.destroy"}],
    route: function(name, params) {
      var route = this.searchRoute(name),
          rootUrl = this.getRootUrl();

      if (route) {
        var compiled = this.buildParams(route, params);
        return rootUrl + '/' + compiled;
      }

    },
    searchRoute: function(name) {
      for (var i = this.routes.length - 1; i >= 0; i--) {
        if (this.routes[i].name == name) {
          return this.routes[i];
        }
      }
    },
    buildParams: function(route, params) {
      var compiled = route.uri,
          queryParams = {};

      for(var key in params) {
        if (compiled.indexOf('{' + key + '}') != -1) {
          compiled = compiled.replace('{' + key + '}', params[key]);
        } else {
          queryParams[key] = params[key];
        }
      }

      if (!this.isEmptyObject(queryParams)) {
        return compiled + this.buildQueryString(queryParams);
      }

      return compiled;
    },
    getRootUrl: function() {
      return window.location.protocol + '//' + window.location.host;
    },
    buildQueryString: function(params) {
      var ret = [];
      for (var key in params) {
        ret.push(encodeURIComponent(key) + "=" + encodeURIComponent(params[key]));
      }
      return '?' + ret.join("&");
    },
    isEmptyObject: function(obj) {
      var name;
      for (name in obj) {
        return false;
      }
      return true;
    }
  };
}));