define("core/common", ["jquery"], function(e) {
	e(document).ajaxSend(function(e, t, n) {
		t.setRequestHeader("app-key", window._global.app_key), t.setRequestHeader("access-token", window._global.access_token), "PUT" == n.type && (n.type = "POST", t.setRequestHeader("x-http-method-override", "put"))
	}), e(document).ajaxError(function(e, t) {
		if (console.log(t), response = t.responseJSON, 403 == t.status) {
			var n = encodeURIComponent(document.location.href);
			window.location.href = _global.shop_url + "welcome/resign?redirect_uri=" + n
		}
	})
}), define("apps/newoutlet/models/apply", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "is_be_distributor?id=" + _global.shop.id
		}
	})
}), function() {
	function e() {
		var e = {
			"&": "&#38;",
			"<": "&#60;",
			">": "&#62;",
			'"': "&#34;",
			"'": "&#39;",
			"/": "&#47;"
		},
			t = /&(?!#?\w+;)|<|>|"|'|\//g;
		return function() {
			return this ? this.replace(t, function(t) {
				return e[t] || t
			}) : this
		}
	}
	function t(e, n, s) {
		return ("string" == typeof n ? n : n.toString()).replace(e.define || l, function(t, n, a, i) {
			return 0 === n.indexOf("def.") && (n = n.substring(4)), n in s || (":" === a ? (e.defineParams && i.replace(e.defineParams, function(e, t, a) {
				s[n] = {
					arg: t,
					text: a
				}
			}), n in s || (s[n] = i)) : new Function("def", "def['" + n + "']=" + i)(s)), ""
		}).replace(e.use || l, function(n, a) {
			e.useParams && (a = a.replace(e.useParams, function(e, t, n, a) {
				if (s[n] && s[n].arg && a) {
					var i = (n + ":" + a).replace(/'|\\/g, "_");
					return s.__exp = s.__exp || {}, s.__exp[i] = s[n].text.replace(new RegExp("(^|[^\\w$])" + s[n].arg + "([^\\w$])", "g"), "$1" + a + "$2"), t + "def.__exp['" + i + "']"
				}
			}));
			var i = new Function("def", "return " + a)(s);
			return i ? t(e, i, s) : i
		})
	}
	function n(e) {
		return e.replace(/\\('|\\)/g, "$1").replace(/[\r\t\n]/g, " ")
	}
	var s, a = {
		version: "1.0.1",
		templateSettings: {
			evaluate: /\{\{([\s\S]+?(\}?)+)\}\}/g,
			interpolate: /\{\{=([\s\S]+?)\}\}/g,
			encode: /\{\{!([\s\S]+?)\}\}/g,
			use: /\{\{#([\s\S]+?)\}\}/g,
			useParams: /(^|[^\w$])def(?:\.|\[[\'\"])([\w$\.]+)(?:[\'\"]\])?\s*\:\s*([\w$\.]+|\"[^\"]+\"|\'[^\']+\'|\{[^\}]+\})/g,
			define: /\{\{##\s*([\w\.$]+)\s*(\:|=)([\s\S]+?)#\}\}/g,
			defineParams: /^\s*([\w$]+):([\s\S]+)/,
			conditional: /\{\{\?(\?)?\s*([\s\S]*?)\s*\}\}/g,
			iterate: /\{\{~\s*(?:\}\}|([\s\S]+?)\s*\:\s*([\w$]+)\s*(?:\:\s*([\w$]+))?\s*\}\})/g,
			varname: "it",
			strip: !0,
			append: !0,
			selfcontained: !1
		},
		template: void 0,
		compile: void 0
	};
	"undefined" != typeof module && module.exports ? module.exports = a : "function" == typeof define && define.amd ? define("doT", [], function() {
		return a
	}) : (s = function() {
		return this || (0, eval)("this")
	}(), s.doT = a), String.prototype.encodeHTML = e();
	var i = {
		append: {
			start: "'+(",
			end: ")+'",
			endencode: "||'').toString().encodeHTML()+'"
		},
		split: {
			start: "';out+=(",
			end: ");out+='",
			endencode: "||'').toString().encodeHTML();out+='"
		}
	},
		l = /$^/;
	a.template = function(s, r, o) {
		r = r || a.templateSettings;
		var c, d, p = r.append ? i.append : i.split,
			u = 0,
			h = r.use || r.define ? t(r, s, o || {}) : s;
		h = ("var out='" + (r.strip ? h.replace(/(^|\r|\n)\t* +| +\t*(\r|\n|$)/g, " ").replace(/\r|\n|\t|\/\*[\s\S]*?\*\//g, "") : h).replace(/'|\\/g, "\\$&").replace(r.interpolate || l, function(e, t) {
			return p.start + n(t) + p.end
		}).replace(r.encode || l, function(e, t) {
			return c = !0, p.start + n(t) + p.endencode
		}).replace(r.conditional || l, function(e, t, s) {
			return t ? s ? "';}else if(" + n(s) + "){out+='" : "';}else{out+='" : s ? "';if(" + n(s) + "){out+='" : "';}out+='"
		}).replace(r.iterate || l, function(e, t, s, a) {
			return t ? (u += 1, d = a || "i" + u, t = n(t), "';var arr" + u + "=" + t + ";if(arr" + u + "){var " + s + "," + d + "=-1,l" + u + "=arr" + u + ".length-1;while(" + d + "<l" + u + "){" + s + "=arr" + u + "[" + d + "+=1];out+='") : "';} } out+='"
		}).replace(r.evaluate || l, function(e, t) {
			return "';" + n(t) + "out+='"
		}) + "';return out;").replace(/\n/g, "\\n").replace(/\t/g, "\\t").replace(/\r/g, "\\r").replace(/(\s|;|\}|^|\{)out\+='';/g, "$1").replace(/\+''/g, "").replace(/(\s|;|\}|^|\{)out\+=''\+/g, "$1out+="), c && r.selfcontained && (h = "String.prototype.encodeHTML=(" + e.toString() + "());" + h);
		try {
			return new Function(r.varname, h)
		} catch (m) {
			throw "undefined" != typeof console && console.log("Could not create a template function: " + h), m
		}
	}, a.compile = function(e, t) {
		return a.template(e, null, t)
	}
}(), define("apps/newoutlet/models/extend_field", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "extend_field/?shop_id=" + _global.shop.id
		}
	})
}), define("text!apps/newoutlet/templates/apply_form.html", [], function() {
	return '{{if(it.code == 1003){}}\n<p class="notice" style="padding-bottom:0;">欢迎加入<span class="orange">{{=_global.shop.name}}</span>，请填写申请信息！</p>\n<p class="notice" style="padding: 0 10px;">邀请人：\n    <span class="orange">\n    {{if(typeof(_lockInfo) == \'undefined\' || _lockInfo.is_lock == \'0\'){}}\n    {{if(typeof(_global.did) != \'undefined\'){}}{{?typeof(_global.outlet_distributor_name) != \'undefined\'}}{{=_global.outlet_distributor_name}}{{?}}{{}else{}}总部{{}}}</span> (请核对)\n    {{}else{}}\n    {{=_lockInfo.name}}</span> (请核对)\n    {{}}}\n</p>\n<div class="from-control">\n    <div class="input-group">\n        <input class="text input" name="name" placeholder="请填写真实姓名，用于佣金结算" />\n    </div>\n\n    <div class="input-group">\n        <input class="text input" name="mobile" placeholder="请填写手机号码方便联系" />\n    </div>\n\n    {{for(var i in it.extends){}}\n    <div class="input-group">\n        <input class="text input {{?(it.extends[i].is_required == \'1\')}}require{{?}}" data-id="{{=it.extends[i].id}}" data-name="{{=it.extends[i].name}}" name="extend" placeholder="请填写{{=it.extends[i].name}}" />\n    </div>\n    {{}}}\n</div>\n<a href="javascript:;" class="js-apply-btn btn btn-warning btn-big" style="margin:0 10px 25px;">申请成为分销商</a>\n{{}else if(it.code == 1004){}}\n<p class="notice">本店累计消费满<span class="orange"> {{=it.data.condition_money}} </span>元，才可申请成为{{=_global.shop.name}}分销商，您已消费<span class="orange"> {{=it.data.order_amount}} </span>元，请继续努力！</p>\n<a href="{{=_global.shop_url}}{{?_global.did != undefined}}?did={{=_global.did}}{{?}}" class="btn btn-warning btn-big" style="margin:0 10px 25px;"><i class="iconfont">&#xe624</i> 继续购物</a>\n{{}}}\n<div class="row">\n    <div class="hd">分销商特权</div>\n    <div class="bd">\n        <div class="item">\n            <i class="iconfont" style="color:#33cd32;">&#xe61b</i>\n            <div class="info">\n                <p class="f14 mb5">独立微店</p>\n                <p class="f12 gray">拥有自己的微店及推广二维码；</p>\n            </div>\n        </div>\n        <!--<div class="item">\n            <i class="iconfont" style="color:#f60;">&#xe605</i>\n            <div class="info">\n                <p class="f14 mb5">采购返现</p>\n                <p class="f12 gray">自己采购，您可获得厂家返现优惠；</p>\n            </div>\n        </div>-->\n        <div class="item">\n            <i class="iconfont" style="color:#fece00;">&#xe606</i>\n            <div class="info">\n                <p class="f14 mb5">销售拿佣金</p>\n                <p class="f12 gray">微店卖出商品，您可以获得佣金；</p>\n            </div>\n        </div>\n        <div class="item">\n            <p class="f12 tint-gray" style="line-height:18px;">分销商的商品销售统一由厂家直接收款、直接发货，并提供产品的售后服务，分销佣金由厂家统一设置。</p>\n        </div>\n    </div>\n</div>'
}), define("apps/newoutlet/views/apply_form", ["backbone", "doT", "apps/newoutlet/models/extend_field", "text!apps/newoutlet/templates/apply_form.html"], function(e, t, n, s) {
	return e.View.extend({
		template: t.template(s),
		events: {
			"click .js-apply-btn": "apply"
		},
		initialize: function() {
			this.extendaModel = new n, this.extendaModel.on("sync", this.load, this)
		},
		render: function() {
			return console.log(_global), this.extendaModel.fetch(), this
		},
		load: function() {
			this.model.set("extends", this.extendaModel.toJSON()), this.$el.html(this.template(this.model.toJSON())), $(".loading").hide()
		},
		apply: function(e) {
			var t = this,
				n = $('input[name="name"]', this.$el).val(),
				s = $('input[name="mobile"]', this.$el).val();
			if ("" == n || null == n) return alert("请填写真实姓名"), !1;
			if (!s || !/^\d+$/.test(s)) return alert("请填写正确的手机"), !1;
			var a = {
				shop_id: _global.shop.id,
				name: n,
				mobile: s
			},
				i = new Array,
				l = !0;
			return $("input[name='extend']").each(function() {
				var e = $(this).data("id"),
					t = $(this).data("name"),
					n = $.trim($(this).val());
				$(this).hasClass("require") && "" == n && (alert("请填写" + t), l = !1);
				var s = {};
				s.id = e, s.value = n, i.push(s)
			}), 0 == l ? !1 : (a.field = JSON.stringify(i), a.did = 0, "undefined" == typeof _lockInfo || "0" == _lockInfo.is_lock ? void 0 != _global.did && (a.did = _global.did) : a.did = _lockInfo.id, $(e.target).text("正在提交..."), $(e.target).removeClass("js-apply-btn"), void $.ajax({
				url: _global.url.api + "outlet_distributor",
				type: "POST",
				data: a,
				success: function(e) {
					console.log(e), t.model.fetch(t.model.get("data"))
				},
				error: function(e) {
					console.log(e)
				}
			}))
		}
	})
}), define("text!apps/newoutlet/templates/apply.html", [], function() {
	return '<div id="header">\n    {{if(typeof(_global.outletbg.img) != \'undefined\'){}}\n    <img class="banner" src="{{=_global.outletbg.img}}">\n    {{}else{}}\n    <img class="banner" src="'+window.global_website+'assets/img/wap/outlet/banner_bg.jpg">\n    {{}}}\n</div>\n<div id="content"></div>'
}), define("text!apps/newoutlet/templates/apply_status.html", [], function() {
	return '<div class="t_center">\n{{if(it.audit_status == 0){}}\n    <div class="icon-logo">\n        <i class="iconfont" style="color:#8f8f8f;">&#xe62c</i>\n    </div>\n    <p class="f15 gdeep-gray mb20">您的分销申请已经提交，正在审核中！</p>\n    <a class="btn-radius btn-primary" href="{{=_global.shop_url}}{{if(it.parent_id != 0){}}?did={{=it.parent_id}}{{}}}">返回</a>\n{{}else if(it.audit_status == 1){}}\n    <div class="icon-logo">\n        <i class="iconfont" style="color:#00cc32;">&#xe62b</i>\n    </div>\n    <p class="f15 gdeep-gray mb20">您的分销申请已经通过审核！</p>\n    <a class="btn-radius btn-warning" href="{{=_global.shop_url}}?did={{=it.id}}">进入我的小店</a>\n{{}else if(it.audit_status == 2){}}\n    <div class="icon-logo">\n        <i class="iconfont" style="color:#e98818;">&#xe62a</i>\n    </div>\n    <p class="f15 gdeep-gray mb20">对不起！您的分销申请未通过审核！</p>\n    <a class="btn-radius btn-warning js-apply-reset">重新申请</a>\n    <a class="btn-radius btn-primary" href="{{=_global.shop_url}}{{if(it.parent_id != 0){}}?did={{=it.parent_id}}{{}}}">返回</a>\n{{}}}\n</div>'
}), define("apps/newoutlet/views/apply", ["backbone", "doT", "apps/newoutlet/models/apply", "apps/newoutlet/views/apply_form", "text!apps/newoutlet/templates/apply.html", "text!apps/newoutlet/templates/apply_status.html"], function(e, t, n, s, a, i) {
	var l = $("#views");
	return e.View.extend({
		id: "view-apply",
		className: "page-view view-apply",
		template: t.template(a),
		events: {
			"click .js-apply-reset": "reset"
		},
		initialize: function() {
			this.model = new n, this.listenTo(this.model, "sync", this.render)
		},
		render: function() {
			if (1001 == this.model.get("code")) {
				l.html(this.$el.html(this.template()));
				var e = t.template(i);
				$("#content", this.$el).html(e(this.model.get("data")))
			} else {
				if (1003 == this.model.get("code") && ("" == _global.member.name || null == _global.member.name)) return window.location.href = _global.shop_url + "outlet/oauth/?redirect_uri=" + _global.shop_url + "outlet", !1;
				l.html(this.$el.html(this.template()));
				var n = new s({
					model: this.model
				});
				$("#content", this.$el).html(n.render().$el)
			}
			return $(".loading").hide(), this
		},
		reset: function() {
			this.model.set("code", 1003);
			var e = new s({
				model: this.model
			});
			$("#content", this.$el).html(e.render().$el)
		}
	})
}), function(e) {
	if ("object" == typeof exports) module.exports = e(require("underscore"), require("backbone"));
	else if ("function" == typeof define && define.amd) define("backbone.paginator", ["underscore", "backbone"], e);
	else if ("undefined" != typeof _ && "undefined" != typeof Backbone) {
		var t = Backbone.PageableCollection,
			n = e(_, Backbone);
		Backbone.PageableCollection.noConflict = function() {
			return Backbone.PageableCollection = t, n
		}
	}
}(function(e, t) {
	function n(t, n) {
		if (!e.isNumber(t) || e.isNaN(t) || !e.isFinite(t) || ~~t !== t) throw new TypeError("`" + n + "` must be a finite integer");
		return t
	}
	function s(e) {
		for (var t, n, s, a, i = {}, l = decodeURIComponent, r = e.split("&"), o = 0, c = r.length; c > o; o++) {
			var d = r[o];
			t = d.split("="), n = t[0], s = t[1] || !0, n = l(n), s = l(s), a = i[n], m(a) ? a.push(s) : i[n] = a ? [a, s] : s
		}
		return i
	}
	function a(e, t, n) {
		var s = e._events[t];
		if (s && s.length) {
			var a = s[s.length - 1],
				i = a.callback;
			a.callback = function() {
				try {
					i.apply(this, arguments), n()
				} catch (e) {
					throw e
				} finally {
					a.callback = i
				}
			}
		} else n()
	}
	var i = e.extend,
		l = e.omit,
		r = e.clone,
		o = e.each,
		c = e.pick,
		d = e.contains,
		p = e.isEmpty,
		u = e.pairs,
		h = e.invert,
		m = e.isArray,
		f = e.isFunction,
		g = e.isObject,
		v = e.keys,
		_ = e.isUndefined,
		b = Math.ceil,
		w = Math.floor,
		y = Math.max,
		$ = t.Collection.prototype,
		x = /[\s'"]/g,
		k = /[<>\s'"]/g,
		P = t.PageableCollection = t.Collection.extend({
			state: {
				firstPage: 1,
				lastPage: null,
				currentPage: null,
				pageSize: 25,
				totalPages: null,
				totalRecords: null,
				sortKey: null,
				order: -1
			},
			mode: "server",
			queryParams: {
				currentPage: "page",
				pageSize: "per_page",
				totalPages: "total_pages",
				totalRecords: "total_entries",
				sortKey: "sort_by",
				order: "order",
				directions: {
					"-1": "asc",
					1: "desc"
				}
			},
			constructor: function(e, t) {
				$.constructor.apply(this, arguments), t = t || {};
				var n = this.mode = t.mode || this.mode || j.mode,
					s = i({}, j.queryParams, this.queryParams, t.queryParams || {});
				s.directions = i({}, j.queryParams.directions, this.queryParams.directions, s.directions || {}), this.queryParams = s;
				var a = this.state = i({}, j.state, this.state, t.state || {});
				a.currentPage = null == a.currentPage ? a.firstPage : a.currentPage, m(e) || (e = e ? [e] : []), e = e.slice(), "server" == n || null != a.totalRecords || p(e) || (a.totalRecords = e.length), this.switchMode(n, i({
					fetch: !1,
					resetState: !1,
					models: e
				}, t));
				var l = t.comparator;
				if (a.sortKey && !l && this.setSorting(a.sortKey, a.order, t), "server" != n) {
					var o = this.fullCollection;
					l && t.full && (this.comparator = null, o.comparator = l), t.full && o.sort(), e && !p(e) && (this.reset(e, i({
						silent: !0
					}, t)), this.getPage(a.currentPage), e.splice.apply(e, [0, e.length].concat(this.models)))
				}
				this._initState = r(this.state)
			},
			_makeFullCollection: function(e, n) {
				var s, a, i, l = ["url", "model", "sync", "comparator"],
					r = this.constructor.prototype,
					o = {};
				for (s = 0, a = l.length; a > s; s++) i = l[s], _(r[i]) || (o[i] = r[i]);
				var c = new(t.Collection.extend(o))(e, n);
				for (s = 0, a = l.length; a > s; s++) i = l[s], this[i] !== r[i] && (c[i] = this[i]);
				return c
			},
			_makeCollectionEventHandler: function(e, t) {
				return function(n, s, l, c) {
					var d = e._handlers;
					o(v(d), function(n) {
						var s = d[n];
						e.off(n, s), t.off(n, s)
					});
					var p = r(e.state),
						u = p.firstPage,
						h = 0 === u ? p.currentPage : p.currentPage - 1,
						m = p.pageSize,
						f = h * m,
						g = f + m;
					if ("add" == n) {
						var w, y, $, x, c = c || {};
						if (l == t) y = t.indexOf(s), y >= f && g > y && (x = e, w = $ = y - f);
						else {
							w = e.indexOf(s), y = f + w, x = t;
							var $ = _(c.at) ? y : c.at + f
						}
						if (c.onRemove || (++p.totalRecords, delete c.onRemove), e.state = e._checkState(p), x) {
							x.add(s, i({}, c || {}, {
								at: $
							}));
							var k = w >= m ? s : !_(c.at) && g > $ && e.length > m ? e.at(m) : null;
							k && a(l, n, function() {
								e.remove(k, {
									onAdd: !0
								})
							})
						}
					}
					if ("remove" == n) if (c.onAdd) delete c.onAdd;
					else {
						if (--p.totalRecords) {
							var P = p.totalPages = b(p.totalRecords / m);
							p.lastPage = 0 === u ? P - 1 : P || u, p.currentPage > P && (p.currentPage = p.lastPage)
						} else p.totalRecords = null, p.totalPages = null;
						e.state = e._checkState(p);
						var j, S = c.index;
						l == e ? ((j = t.at(g)) ? a(e, n, function() {
							e.push(j, {
								onRemove: !0
							})
						}) : !e.length && p.totalRecords && e.reset(t.models.slice(f - m, g - m), i({}, c, {
							parse: !1
						})), t.remove(s)) : S >= f && g > S && ((j = t.at(g - 1)) && a(e, n, function() {
							e.push(j, {
								onRemove: !0
							})
						}), e.remove(s), !e.length && p.totalRecords && e.reset(t.models.slice(f - m, g - m), i({}, c, {
							parse: !1
						})))
					}
					if ("reset" == n) if (c = l, l = s, l == e && null == c.from && null == c.to) {
						var R = t.models.slice(0, f),
							C = t.models.slice(f + e.models.length);
						t.reset(R.concat(e.models).concat(C), c)
					} else l == t && ((p.totalRecords = t.models.length) || (p.totalRecords = null, p.totalPages = null), "client" == e.mode && (p.lastPage = p.currentPage = p.firstPage), e.state = e._checkState(p), e.reset(t.models.slice(f, g), i({}, c, {
						parse: !1
					})));
					"sort" == n && (c = l, l = s, l === t && e.reset(t.models.slice(f, g), i({}, c, {
						parse: !1
					}))), o(v(d), function(n) {
						var s = d[n];
						o([e, t], function(e) {
							e.on(n, s);
							var t = e._events[n] || [];
							t.unshift(t.pop())
						})
					})
				}
			},
			_checkState: function(e) {
				var t = this.mode,
					s = this.links,
					a = e.totalRecords,
					i = e.pageSize,
					l = e.currentPage,
					r = e.firstPage,
					o = e.totalPages;
				if (null != a && null != i && null != l && null != r && ("infinite" == t ? s : !0)) {
					if (a = n(a, "totalRecords"), i = n(i, "pageSize"), l = n(l, "currentPage"), r = n(r, "firstPage"), 1 > i) throw new RangeError("`pageSize` must be >= 1");
					if (o = e.totalPages = b(a / i), 0 > r || r > 1) throw new RangeError("`firstPage must be 0 or 1`");
					if (e.lastPage = 0 === r ? y(0, o - 1) : o || r, "infinite" == t) {
						if (!s[l + ""]) throw new RangeError("No link found for page " + l)
					} else if (r > l || o > 0 && (r ? l > o : l >= o)) throw new RangeError("`currentPage` must be firstPage <= currentPage " + (r ? ">" : ">=") + " totalPages if " + r + "-based. Got " + l + ".")
				}
				return e
			},
			setPageSize: function(e, t) {
				e = n(e, "pageSize"), t = t || {
					first: !1
				};
				var s = this.state,
					a = b(s.totalRecords / e),
					r = a ? y(s.firstPage, w(a * s.currentPage / s.totalPages)) : s.firstPage;
				return s = this.state = this._checkState(i({}, s, {
					pageSize: e,
					currentPage: t.first ? s.firstPage : r,
					totalPages: a
				})), this.getPage(s.currentPage, l(t, ["first"]))
			},
			switchMode: function(t, n) {
				if (!d(["server", "client", "infinite"], t)) throw new TypeError('`mode` must be one of "server", "client" or "infinite"');
				n = n || {
					fetch: !0,
					resetState: !0
				};
				var s = this.state = n.resetState ? r(this._initState) : this._checkState(i({}, this.state));
				this.mode = t;
				var a, c = this,
					p = this.fullCollection,
					u = this._handlers = this._handlers || {};
				if ("server" == t || p)"server" == t && p && (o(v(u), function(e) {
					a = u[e], c.off(e, a), p.off(e, a)
				}), delete this._handlers, this._fullComparator = p.comparator, delete this.fullCollection);
				else {
					p = this._makeFullCollection(n.models || [], n), p.pageableCollection = this, this.fullCollection = p;
					var h = this._makeCollectionEventHandler(this, p);
					o(["add", "remove", "reset", "sort"], function(t) {
						u[t] = a = e.bind(h, {}, t), c.on(t, a), p.on(t, a)
					}), p.comparator = this._fullComparator
				}
				if ("infinite" == t) for (var m = this.links = {}, f = s.firstPage, g = b(s.totalRecords / s.pageSize), _ = 0 === f ? y(0, g - 1) : g || f, w = s.firstPage; _ >= w; w++) m[w] = this.url;
				else this.links && delete this.links;
				return n.fetch ? this.fetch(l(n, "fetch", "resetState")) : this
			},
			hasPreviousPage: function() {
				var e = this.state,
					t = e.currentPage;
				return "infinite" != this.mode ? t > e.firstPage : !! this.links[t - 1]
			},
			hasNextPage: function() {
				var e = this.state,
					t = this.state.currentPage;
				return "infinite" != this.mode ? t < e.lastPage : !! this.links[t + 1]
			},
			getFirstPage: function(e) {
				return this.getPage("first", e)
			},
			getPreviousPage: function(e) {
				return this.getPage("prev", e)
			},
			getNextPage: function(e) {
				return this.getPage("next", e)
			},
			getLastPage: function(e) {
				return this.getPage("last", e)
			},
			getPage: function(e, t) {
				var s = this.mode,
					a = this.fullCollection;
				t = t || {
					fetch: !1
				};
				var r = this.state,
					o = r.firstPage,
					c = r.currentPage,
					d = r.lastPage,
					u = r.pageSize,
					h = e;
				switch (e) {
				case "first":
					h = o;
					break;
				case "prev":
					h = c - 1;
					break;
				case "next":
					h = c + 1;
					break;
				case "last":
					h = d;
					break;
				default:
					h = n(e, "index")
				}
				this.state = this._checkState(i({}, r, {
					currentPage: h
				})), t.from = c, t.to = h;
				var m = (0 === o ? h : h - 1) * u,
					f = a && a.length ? a.models.slice(m, m + u) : [];
				return "client" != s && ("infinite" != s || p(f)) || t.fetch ? ("infinite" == s && (t.url = this.links[h]), this.fetch(l(t, "fetch"))) : (this.reset(f, l(t, "fetch")), this)
			},
			getPageByOffset: function(e, t) {
				if (0 > e) throw new RangeError("`offset must be > 0`");
				e = n(e);
				var s = w(e / this.state.pageSize);
				return 0 !== this.state.firstPage && s++, s > this.state.lastPage && (s = this.state.lastPage), this.getPage(s, t)
			},
			sync: function(e, n, s) {
				var a = this;
				if ("infinite" == a.mode) {
					var l = s.success,
						r = a.state.currentPage;
					s.success = function(e, t, n) {
						var o = a.links,
							c = a.parseLinks(e, i({
								xhr: n
							}, s));
						c.first && (o[a.state.firstPage] = c.first), c.prev && (o[r - 1] = c.prev), c.next && (o[r + 1] = c.next), l && l(e, t, n)
					}
				}
				return ($.sync || t.sync).call(a, e, n, s)
			},
			parseLinks: function(e, t) {
				var n = {},
					s = t.xhr.getResponseHeader("Link");
				if (s) {
					var a = ["first", "prev", "next"];
					o(s.split(","), function(e) {
						var t = e.split(";"),
							s = t[0].replace(k, ""),
							i = t.slice(1);
						o(i, function(e) {
							var t = e.split("="),
								i = t[0].replace(x, ""),
								l = t[1].replace(x, "");
							"rel" == i && d(a, l) && (n[l] = s)
						})
					})
				}
				return n
			},
			parse: function(e, t) {
				var n = this.parseState(e, r(this.queryParams), r(this.state), t);
				return n && (this.state = this._checkState(i({}, this.state, n))), this.parseRecords(e, t)
			},
			parseState: function(t, n, s) {
				if (t && 2 === t.length && g(t[0]) && m(t[1])) {
					var a = r(s),
						i = t[0];
					return o(u(l(n, "directions")), function(t) {
						var n = t[0],
							s = t[1],
							l = i[s];
						_(l) || e.isNull(l) || (a[n] = i[s])
					}), i.order && (a.order = 1 * h(n.directions)[i.order]), a
				}
			},
			parseRecords: function(e) {
				return e && 2 === e.length && g(e[0]) && m(e[1]) ? e[1] : e
			},
			fetch: function(e) {
				e = e || {};
				var t = this._checkState(this.state),
					n = this.mode;
				"infinite" != n || e.url || (e.url = this.links[t.currentPage]);
				var a = e.data || {},
					o = e.url || this.url || "";
				f(o) && (o = o.call(this));
				var d = o.indexOf("?"); - 1 != d && (i(a, s(o.slice(d + 1))), o = o.slice(0, d)), e.url = o, e.data = a;
				var p, h, m, g, b = "client" == this.mode ? c(this.queryParams, "sortKey", "order") : l(c(this.queryParams, v(j.queryParams)), "directions"),
					w = u(b),
					y = r(this);
				for (p = 0; p < w.length; p++) h = w[p], m = h[0], g = h[1], g = f(g) ? g.call(y) : g, null != t[m] && null != g && (a[g] = t[m]);
				if (t.sortKey && t.order) {
					var x = f(b.order) ? b.order.call(y) : b.order;
					a[x] = this.queryParams.directions[t.order + ""]
				} else t.sortKey || delete a[b.order];
				var k = u(l(this.queryParams, v(j.queryParams)));
				for (p = 0; p < k.length; p++) h = k[p], g = h[1], g = f(g) ? g.call(y) : g, null != g && (a[h[0]] = g);
				if ("server" != n) {
					var P = this,
						S = this.fullCollection,
						R = e.success;
					return e.success = function(t, s, a) {
						a = a || {}, _(e.silent) ? delete a.silent : a.silent = e.silent;
						var l = t.models;
						"client" == n ? S.reset(l, a) : (S.add(l, i({
							at: S.length
						}, i(a, {
							parse: !1
						}))), P.trigger("reset", P, a)), R && R(t, s, a)
					}, $.fetch.call(this, i({}, e, {
						silent: !0
					}))
				}
				return $.fetch.call(this, e)
			},
			_makeComparator: function(e, t, n) {
				var s = this.state;
				return e = e || s.sortKey, t = t || s.order, e && t ? (n || (n = function(e, t) {
					return e.get(t)
				}), function(s, a) {
					var i, l = n(s, e),
						r = n(a, e);
					return 1 === t && (i = l, l = r, r = i), l === r ? 0 : r > l ? -1 : 1
				}) : void 0
			},
			setSorting: function(e, t, n) {
				var s = this.state;
				s.sortKey = e, s.order = t = t || s.order;
				var a = this.fullCollection,
					l = !1,
					r = !1;
				e || (l = r = !0);
				var o = this.mode;
				n = i({
					side: "client" == o ? o : "server",
					full: !0
				}, n);
				var c = this._makeComparator(e, t, n.sortValue),
					d = n.full,
					p = n.side;
				return "client" == p ? d ? (a && (a.comparator = c), l = !0) : (this.comparator = c, r = !0) : "server" != p || d || (this.comparator = c), l && (this.comparator = null), r && a && (a.comparator = null), this
			}
		}),
		j = P.prototype;
	return P
}), define("apps/newoutlet/models/earn", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "outlet_icome_info"
		}
	})
}), define("apps/newoutlet/collections/earn", ["backbone.paginator", "apps/newoutlet/models/earn"], function(e, t) {
	return Backbone.PageableCollection.extend({
		model: t,
		url: _global.url.api + "outlet_icome_list",
		state: {
			pagesInRange: 0,
			pageSize: 10,
			sortKey: "dt_add",
			order: 1
		},
		queryParams: {
			totalPages: null,
			totalRecords: null,
			pageSize: "limit",
			offset: function() {
				return (this.state.currentPage - 1) * this.state.pageSize
			},
			sort: "id",
			distributor_id: _global.did
		},
		parseState: function(e) {
			return {
				totalRecords: e._count,
				total_cash: e.total_cash,
				dlevel1_count: e.dlevel1_count,
				dlevel2_count: e.dlevel2_count,
				dlevel3_count: e.dlevel3_count
			}
		},
		parseRecords: function(e) {
			return e.data
		}
	})
}), define("apps/newoutlet/models/earn_info", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "outlet_icome_info?order_id=" + this.get("order_id") + "&level=" + this.get("level")
		}
	})
}), define("text!apps/newoutlet/templates/earn_item.html", [], function() {
	return '<div class="earn-info clearfix js-earn-info">\r\n    <div class="left">\r\n        <div class="earn-date">{{=it.dt_add}}</div>\r\n        <div class="earn-id">\r\n            {{?it.dlevel==\'1\'}}\r\n            一级订单：\r\n            {{??it.dlevel==\'2\'}}\r\n            二级订单：\r\n            {{??it.dlevel==\'3\'}}\r\n            三级订单：\r\n            {{?}}\r\n            {{=it.order_sn}}</div>\r\n    </div>\r\n    <div class="right">\r\n        {{if(it.income_status==-1){}}\r\n            {{?it.order_status_name==\'退款完成\'||it.order_status_name==\'已取消\'}}\r\n            <p class="price tlt t_right">+{{=it.commission}}</p>\r\n            {{??}}\r\n            <p class="price t_right">+{{=it.commission}}</p>\r\n            {{?}}\r\n            <div class="status gray">{{=it.order_status_name}}</div>\r\n        {{}else if(it.income_status==0){}}\r\n        <p class="price">+{{=it.commission}}</p>\r\n            {{?it.order_status_name==\'待付款\'||it.order_status_name==\'退款中\'}}\r\n            <div class="status red">{{=it.order_status_name}}</div>\r\n            {{??}}\r\n            <div class="status green">{{=it.order_status_name}}</div>\r\n            {{?}}\r\n        {{}else if(it.income_status==1){}}\r\n        <p class="price t_right">+{{=it.commission}}</p>\r\n        <div class="status gray">{{=it.order_status_name}}</div>\r\n        {{}}}\r\n    </div>\r\n</div>'
}), define("text!apps/newoutlet/templates/earn_info.html", [], function() {
	return '<div class="order-detail">\r\n    {{?(_global.shop.stype == \'1\')}}\r\n    <div class="outlet-info">\r\n        <div><span>分销商：</span>{{=it.name}}（{{=it.mobile}}）</div>\r\n    </div>\r\n    {{?}}\r\n    <dl class="goods-list">\r\n        {{for(var i in it.goodses){}}\r\n        <dd class="clearfix">\r\n            <a href="{{=_global.shop_url}}goods/{{=it.goodses[i].goods_id}}">\r\n            <div class="goods-image"><img src="{{=it.goodses[i].img}}" alt=""></div>\r\n            <div class="goods-name">{{=it.goodses[i].title}}</div>\r\n            <div class="goods-price">\r\n                <span>X{{=it.goodses[i].quantity}}</span>\r\n                {{if(it.goodses[i].refund == 1){}}\r\n                <span class="gray tlt">+{{=it.goodses[i].income}}</span>\r\n                {{}else{}}\r\n                <span class="gray">+{{=it.goodses[i].income}}</span>\r\n                {{}}}\r\n            </div>\r\n            </a>\r\n        </dd>\r\n        {{}}}\r\n    </dl>\r\n    <div class="address">\r\n    <div><span>客户名：</span>{{=it.member_name}}</div>\r\n    {{if(it.shipping.type == 1){}}\r\n    <div><span>收货人：</span>{{=it.consignee}}（{{=it.phone}}）</div>\r\n    <div><span>收货地址：</span>{{=it.province.name}}{{=it.city.name}}{{=it.district.name||\'\'}}***</div>\r\n    {{}else{}}\r\n    {{?(typeof(it.shipping.name) != \'undefined\')}}<div><span>配送方式：</span>{{=it.shipping.name}}　{{=it.consignee}}（{{=it.phone}}）</div>{{?}}\r\n    {{}}}\r\n    {{?(it.logis_no != \'\' && it.logis_no != null)}}\r\n        <a style="color: #0081c4;" href="{{=_global.my_url}}logistics/{{=it.order_id}}">查看物流</a>\r\n    {{?}}\r\n    </div>\r\n</div>'
}), define("apps/newoutlet/views/earn_item", ["backbone", "doT", "apps/newoutlet/models/earn_info", "text!apps/newoutlet/templates/earn_item.html", "text!apps/newoutlet/templates/earn_info.html"], function(e, t, n, s, a) {
	return e.View.extend({
		className: "panel",
		tagName: "li",
		template: t.template(s),
		events: {
			"click .js-earn-info": "info"
		},
		initialize: function() {
			this.listenTo(this.model, "sync", this.render)
		},
		render: function() {
			return this.$el.html(this.template(this.model.toJSON())), this
		},
		renderInfo: function() {
			if (this.$el.hasClass("on")) this.$el.removeClass("on"), this.$el.children("div.order-detail").remove();
			else {
				$(".panel").removeClass("on"), $(".panel").find("div.order-detail").remove(), this.$el.addClass("on");
				var e = t.template(a);
				this.$el.append(e(this.infoModel.get("data")))
			}
		},
		info: function() {
			this.infoModel = new n, this.listenTo(this.infoModel, "sync", this.renderInfo), this.infoModel.set({
				order_id: this.model.get("order_id"),
				level: this.model.get("dlevel")
			}), this.infoModel.fetch()
		}
	})
}), define("text!components/pager/templates/default.html", [], function() {
	return '<ul class="pagination pull-right">\n    <li class="total">\n        当前 {{= (it.currentPage-1)*it.pageSize+1 }}-{{= it.totalRecords > (it.currentPage*it.pageSize) ? it.currentPage*it.pageSize : it.totalRecords }} 条\n        共 {{= it.totalRecords }} 条\n    </li>\n    {{ if ((it.firstPage != it.currentPage) && (it.currentPage - it.pagesInRange) > it.firstPage) { }}\n    <li><a href="#" data-page="1">{{= it.firstPage }}</a></li>\n    <li><span>···</span></li>\n    {{ } }}\n\n    {{~ it.pageSet:p:i }}\n    {{ if (it.currentPage == p) { }}\n    <li class="active"><span>{{= p }}</span></li>\n    {{ }else{ }}\n    <li><a href="#" data-page="{{= p }}">{{= p }}</a></li>\n    {{ } }}\n    {{~}}\n\n    {{ if ((it.lastPage != it.currentPage) && ((it.currentPage + it.pagesInRange) < it.lastPage)) { }}\n    <li><span>···</span></li>\n    <li><a href="#" data-page="{{= it.lastPage }}">{{= it.lastPage }}</a></li>\n    {{ } }}\n    {{ if(it.pageSet.length > 0){ }}\n    <li class="jump">\n        <input type="text" class="form-control input-sm" value="{{= it.currentPage+1 }}">\n        <button class="btn btn-default btn-sm" type="button">跳转</button>\n    </li>\n    {{ } }}\n</ul>'
}), define("components/pager/main", ["require", "backbone", "doT", "text!components/pager/templates/default.html"], function(e) {
	var t = e("backbone"),
		n = e("doT"),
		s = e("text!components/pager/templates/default.html");
	return t.View.extend({
		events: {
			"click a": "gotoPage",
			"click .jump button": "jumpPage"
		},
		tagName: "aside",
		template: n.template(s),
		render: function() {
			var e = this.collection.state;
			return e.totalPages > 0 && (e.pageSet = this.setPagination(e), this.$el.html(this.template(e))), this
		},
		gotoPage: function(e) {
			e.preventDefault();
			var t = parseInt($(e.target).attr("data-page"));
			this.collection.getPage(t, {
				reset: !0
			})
		},
		jumpPage: function(e) {
			e.preventDefault();
			var t = $(e.target).prev("input"),
				n = parseInt(t.val());
			n > 0 && n <= this.collection.state.lastPage ? this.collection.getPage(n, {
				reset: !0
			}) : t.select()
		},
		setPagination: function(e) {
			var t = [],
				n = 0,
				s = 0,
				a = 2 * e.pagesInRange,
				i = Math.ceil(e.totalRecords / e.pageSize);
			if (i > 1) if (1 + a >= i) for (n = 1, s = i; s >= n; n++) t.push(n);
			else if (e.currentPage <= e.pagesInRange + 1) for (n = 1, s = 2 + a; s > n; n++) t.push(n);
			else if (i - e.pagesInRange > e.currentPage && e.currentPage > e.pagesInRange) for (n = e.currentPage - e.pagesInRange; n <= e.currentPage + e.pagesInRange; n++) t.push(n);
			else for (n = i - a; i >= n; n++) t.push(n);
			return t
		}
	})
}), define("text!apps/newoutlet/templates/order.html", [], function() {
	return '<header class="top-tab">\r\n    <ul class="clearfix">\r\n        <li class="on js-order-tab" data-status="all"><a>所有订单</a></li>\r\n        <li class="js-order-tab" data-status="{{=_global.order_status_value.order_accepted}}"><a>已付款</a></li>\r\n        <li class="js-order-tab" data-status="{{=_global.order_status_value.order_pending}}"><a>待付款</a></li>\r\n        <li class="js-order-tab" data-status="{{=_global.order_status_value.order_finished}}"><a>已完成</a></li>\r\n    </ul>\r\n</header>\r\n<div class="js-count"></div>\r\n<div class="earn-list">\r\n    <ul class="js-order-cate">\r\n    </ul>\r\n</div>\r\n'
}), define("text!apps/newoutlet/templates/list_empty.html", [], function() {
	return '<div class="list-empty">\r\n    <i class="iconfont">&#xe610</i>\r\n    <p>{{=it.info}}</p>\r\n</div>'
}), define("apps/newoutlet/views/order", ["backbone", "doT", "apps/newoutlet/collections/earn", "apps/newoutlet/views/earn_item", "components/pager/main", "text!apps/newoutlet/templates/order.html", "text!apps/newoutlet/templates/list_empty.html"], function(e, t, n, s, a, i, l) {
	var r = $("#views");
	return e.View.extend({
		id: "view-center",
		className: "page-view page-o-oreder",
		template: t.template(i),
		events: {
			"click .js-order-tab": "orderTab"
		},
		initialize: function() {
			this.listCollection = new n, this.listCollection.on("sync", this.renderList, this)
		},
		render: function() {
			return r.html(this.$el.html(this.template)), this.listCollection.fetch(), this
		},
		renderList: function() {
			if (0 == this.listCollection.state.totalRecords) {
				var e = t.template(l);
				$(".js-order-cate", this.$el).html(e({
					info: "亲，您暂无分销订单信息！"
				})), $(".js-count", this.$el).html("")
			} else {
				var n = "";
				null == this.listCollection.queryParams.status && (n += "，分销总收入<span>" + this.listCollection.state.total_cash + "</span>");
				var s = '<div class="count-text">共找到<span>' + this.listCollection.state.totalRecords + "</span>笔订单" + n + "<p>一级<span>" + this.listCollection.state.dlevel1_count + "</span>笔，二级<span>" + this.listCollection.state.dlevel2_count + "</span>笔，三级<span>" + this.listCollection.state.dlevel3_count + "</span>笔。</p></div>";
				$(".js-count", this.$el).html(s), this.listCollection.each(this.renderItem, this), this.bottomLoad()
			}
			$(".loading").hide()
		},
		renderItem: function(e) {
			$(".js-order-cate", this.$el).append(new s({
				model: e
			}).render().$el)
		},
		orderTab: function(e) {
			$(window).off("scroll");
			var t = $(e.currentTarget).attr("data-status");
			$(e.currentTarget).addClass("on"), $(e.currentTarget).siblings().removeClass("on"), this.listCollection.state.currentPage = 1, this.listCollection.queryParams.status = "all" != t ? t : null, $(".js-order-cate", this.$el).html(""), this.listCollection.fetch()
		},
		bottomLoad: function() {
			var e = this;
			$(window).on("scroll", function() {
				var t = $(this).scrollTop(),
					n = $(document).height(),
					s = $(this).height();
				t + s == n && e.listCollection.hasNextPage() && ($(".loading").show(), e.listCollection.getNextPage({
					reset: !0
				}))
			})
		}
	})
}), define("apps/newoutlet/models/team_apply", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "outlet_distributor"
		}
	})
}), define("apps/newoutlet/collections/teams_apply", ["backbone.paginator", "apps/newoutlet/models/team_apply"], function(e, t) {
	return Backbone.PageableCollection.extend({
		model: t,
		url: _global.url.api + "outlet_distributors",
		state: {
			pagesInRange: 0,
			pageSize: 2,
			sortKey: "dt_add",
			order: 1
		},
		queryParams: {
			totalPages: null,
			totalRecords: null,
			pageSize: "limit",
			currentPage: null,
			offset: function() {
				return (this.state.currentPage - 1) * this.state.pageSize
			},
			shop_id: _global.shop.id,
			parent_id: _global.did,
			audit_status: 0,
			action: "apply"
		},
		parseState: function(e) {
			return {
				totalRecords: e._count,
				audit_type: e.audit_type
			}
		},
		parseRecords: function(e) {
			return e.data
		}
	})
}), define("apps/newoutlet/models/team", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "distributors"
		}
	})
}), define("apps/newoutlet/collections/teams", ["backbone.paginator", "apps/newoutlet/models/team"], function(e, t) {
	return Backbone.PageableCollection.extend({
		model: t,
		url: _global.url.api + "outlet/distributors",
		state: {
			pagesInRange: 0,
			pageSize: 15,
			sortKey: "dt_add",
			order: 1
		},
		queryParams: {
			totalPages: null,
			totalRecords: null,
			pageSize: "limit",
			currentPage: null,
			offset: function() {
				return (this.state.currentPage - 1) * this.state.pageSize
			},
			id: _global.did,
			shop_id: _global.shop.id
		},
		parseState: function(e) {
			return {
				totalRecords: e.data._count,
				outletLimit: e.data.c_surplus_distributor
			}
		},
		parseRecords: function(e) {
			return e.data.data
		}
	})
}), define("apps/newoutlet/collections/members", ["backbone.paginator", "apps/newoutlet/models/team"], function(e, t) {
	return Backbone.PageableCollection.extend({
		model: t,
		url: _global.url.api + "outlet_distributor_members",
		state: {
			pagesInRange: 0,
			pageSize: 16,
			sortKey: "dt_add",
			order: 1
		},
		queryParams: {
			totalPages: null,
			totalRecords: null,
			pageSize: "limit",
			currentPage: null,
			offset: function() {
				return (this.state.currentPage - 1) * this.state.pageSize
			},
			did: _global.did
		},
		parseState: function(e) {
			return {
				totalRecords: e.data._count,
				outletLimit: e.data.c_surplus_distributor
			}
		},
		parseRecords: function(e) {
			return e.data.data
		}
	})
}), define("text!apps/newoutlet/templates/team_apply_item.html", [], function() {
	return '{{if(it.avatar == null || it.avatar == ""){}}<img src="'+window.global_website+'assets/img/wap/outlet/default_head_img.jpg">{{}else{}}<img src="{{=it.avatar}}">{{}}}\r\n<div class="info">\r\n    <p class="f15 mb5">{{=it.name}}<span class="phone">{{=it.mobile}}</span></p>\r\n    <p class="tint-gray f12">请求成为您的下级分销商</p>\r\n</div>\r\n<div class="group-btns clearfix">\r\n    <a data-did="{{=it.id}}" class="btn btn-warning js-accept"><span><i class="iconfont">&#xe60b</i> 接受请求</span></a>\r\n    <a data-did="{{=it.id}}" class="btn btn-fail js-refuse"><span><i class="iconfont">&#xe60c</i> 拒绝请求</span></a>\r\n</div>'
}), define("apps/newoutlet/views/team_apply_item", ["backbone", "doT", "text!apps/newoutlet/templates/team_apply_item.html"], function(e, t, n) {
	return e.View.extend({
		className: "item apply-list",
		template: t.template(n),
		events: {
			"click .js-accept": "accept",
			"click .js-refuse": "refuse"
		},
		initialize: function() {
			this.listenTo(this.model, "sync", this.render)
		},
		render: function() {
			return this.$el.html(this.template(this.model.toJSON())), this.delegateEvents(), this
		},
		accept: function() {
			this.undelegateEvents();
			var e = (this.model.get("id"), this);
			this.model.set("audit_status", 1), this.model.save("", "", {
				success: function() {
					e.trigger("change")
				}
			})
		},
		refuse: function() {
			this.undelegateEvents();
			var e = (this.model.get("id"), this);
			this.model.set("audit_status", 2), this.model.save("", "", {
				success: function() {
					e.trigger("change")
				}
			})
		}
	})
}), define("text!apps/newoutlet/templates/team_apply_list.html", [], function() {
	return '{{if(it.length > 0){}}\r\n<div class="layout-full">\r\n    <div class="hd">\r\n        <h3 class="f14">待审核（<span class="red">{{=it.length}}</span>）</h3>\r\n    </div>\r\n    <div class="bd" style="padding: 0;">\r\n        <div class="js-team-list" style="padding: 0;"></div>\r\n        {{if(it.length > it.limit){}}\r\n        <a class="btn gray js-search-all">查看所有申请</a>\r\n        {{}}}\r\n    </div>\r\n    <div class="pager"></div>\r\n</div>\r\n{{}}}\r\n'
}), define("apps/newoutlet/views/team_apply_list", ["backbone", "doT", "apps/newoutlet/views/team_apply_item", "text!apps/newoutlet/templates/team_apply_list.html"], function(e, t, n, s) {
	return e.View.extend({
		el: ".js-team-apply",
		template: t.template(s),
		events: {
			"click .js-search-all": "searchAll"
		},
		initialize: function() {},
		render: function() {
			return "2" != this.collection.state.audit_type && (this.$el.html(this.template({
				length: this.collection.state.totalRecords,
				limit: this.collection.state.pageSize
			})), this.collection.each(this.renderItem, this)), this
		},
		renderItem: function(e) {
			this.itemView = new n({
				model: e
			});
			var t = this;
			$(".js-team-list", this.$el).append(this.itemView.render().$el), this.itemView.on("change", function() {
				$(".js-team-list").html(""), t.collection.fetch({
					reset: !0
				})
			})
		},
		searchAll: function() {
			this.collection.state.pageSize = null;
			var e = this;
			this.collection.fetch({
				success: function() {
					e.render(), $(".js-search-all", this.$el).remove()
				}
			})
		}
	})
}), define("text!apps/newoutlet/templates/team_item.html", [], function() {
	return '{{if(it.avatar == null || it.avatar == ""){}}<img src="'+window.global_website+'assets/img/wap/outlet/default_head_img.jpg">{{}else{}}<img src="{{=it.avatar}}">{{}}}\r\n<div class="info">\r\n    <p class="f15 mb5">{{=it.name}}</p>\r\n    <p class="tint-gray f12">{{=it.dt_add}}</p>\r\n    <!--<p class="tint-gray f12">{{=it.csub}}个下级分销商</p>-->\r\n</div>\r\n<div class="earning">\r\n    {{if(_global.shop.stype == \'1\'){}}\r\n    <p class="f16 mb5">＋{{=it.total_commission}}</p>\r\n    <!--<p class="tint-gray f12">总收入贡献</p>-->\r\n    <p class="tint-gray f12"><span class="red">{{=it.sub_number}}</span> 个成员</p>\r\n    {{}else if(_global.shop.stype == \'2\'){}}\r\n    <p class="f16 mb5">＋{{=it.amount}}</p>\r\n    <p class="tint-gray f12">{{=it.num}} 笔订单</p>\r\n    {{}}}\r\n</div>'
}), define("apps/newoutlet/views/team_item", ["backbone", "doT", "text!apps/newoutlet/templates/team_item.html"], function(e, t, n) {
	return e.View.extend({
		className: "item team-list",
		template: t.template(n),
		events: {},
		initialize: function() {
			this.listenTo(this.model, "sync", this.render)
		},
		render: function() {
			return this.$el.html(this.template(this.model.toJSON())), this.delegateEvents(), this
		}
	})
}), define("text!apps/newoutlet/templates/team_list.html", [], function() {
	return '<div class="hd">\r\n    {{if(_global.shop.stype == \'1\'){}}\r\n    <h3 class="f14">团队成员（<span class="red">{{=it.length}}</span>）</h3>\r\n    {{}else if(_global.shop.stype == \'2\'){}}\r\n    <h3 class="f14">我的客户（<span class="red">{{=it.length}}</span>）</h3>\r\n    {{}}}\r\n    {{?(_global.shop.stype == \'1\')}}\r\n    {{if(it.limit != 0){}}\r\n    <span class="right-remark">还可发展<span class="green">{{=it.limit}}</span>名下级分销商</span>\r\n    {{}}}\r\n    {{?}}\r\n</div>\r\n<div class="bd js-team-list" style="padding: 0;"></div>'
}), define("apps/newoutlet/views/team_list", ["backbone", "doT", "apps/newoutlet/views/team_item", "text!apps/newoutlet/templates/team_list.html", "text!apps/newoutlet/templates/list_empty.html"], function(e, t, n, s, a) {
	return e.View.extend({
		el: ".js-team",
		template: t.template(s),
		events: {},
		initialize: function() {
			this.collection.on("reset", this.renderEach, this)
		},
		render: function() {
			if (0 != this.collection.length) this.$el.html(this.template({
				length: this.collection.state.totalRecords,
				limit: this.collection.state.outletLimit
			})), this.collection.each(this.renderItem, this), this.bottomLoad();
			else {
				var e = t.template(a);
				this.$el.html(e({
					info: "您还没有分销团队，加油发展吧！"
				}))
			}
			return this
		},
		renderItem: function(e) {
			$(".js-team-list", this.$el).append(new n({
				model: e
			}).render().$el), $(".loading").hide()
		},
		renderEach: function() {
			this.collection.each(this.renderItem, this)
		},
		bottomLoad: function() {
			var e = this;
			$(window).scroll(function() {
				var t = $(this).scrollTop(),
					n = $(document).height(),
					s = $(this).height();
				t >= n - s - 20 && e.collection.hasNextPage() && ($(".loading").show(), e.collection.getNextPage({
					reset: !0
				}))
			})
		}
	})
}), define("text!apps/newoutlet/templates/team.html", [], function() {
	return '<div class="js-team-apply"></div>\r\n<div class="layout-full">\r\n    <div class="js-team"></div>\r\n    <div class="pager"></div>\r\n</div>'
}), define("apps/newoutlet/views/team", ["backbone", "doT", "apps/newoutlet/collections/teams_apply", "apps/newoutlet/collections/teams", "apps/newoutlet/collections/members", "apps/newoutlet/views/team_apply_list", "apps/newoutlet/views/team_list", "components/pager/main", "text!apps/newoutlet/templates/team.html"], function(e, t, n, s, a, i, l, r, o) {
	var c = $("#views");
	return e.View.extend({
		template: t.template(o),
		events: {},
		initialize: function() {
			this.applycollection = new n, "1" == _global.shop.stype ? this.teamcollection = new s : "2" == _global.shop.stype && (this.teamcollection = new a), this.applycollection.on("reset", this.renderApplyList, this), this.applycollection.on("reset", function() {
				this.teamcollection.fetch({
					reset: !0
				})
			}, this), this.teamcollection.once("reset", this.renderList, this)
		},
		render: function() {
			return c.html(this.$el.html(this.template())), this.applycollection.fetch({
				reset: !0
			}), this
		},
		renderApplyList: function() {
			{
				var e = new i({
					collection: this.applycollection
				});
				new r({
					collection: this.applycollection
				})
			}
			e.render()
		},
		renderList: function() {
			{
				var e = new l({
					collection: this.teamcollection
				});
				new r({
					collection: this.teamcollection
				})
			}
			e.render(), $(".loading").hide()
		}
	})
}), define("apps/newoutlet/models/distributor", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			try {
				return 1 == this.id ? _global.url.api + "distributor_new?shop_id=" + _global.shop.id + "&type=1" : _global.url.api + "distributor_new?shop_id=" + _global.shop.id
			} catch (e) {}
		}
	})
}), define("apps/newoutlet/models/cash_info", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "outlet_cash_info?shop_id=" + _global.shop.id + "&did=" + _global.did
		}
	})
}), define("text!apps/newoutlet/templates/cash_dialog.html", [], function() {
	return '<div class="bg js-close-dialog"></div>\r\n<div class="body">\r\n    <div class="hd">\r\n        请输入提现信息\r\n        <div class="close js-close-dialog"><i class="iconfont">&#xe616</i></div>\r\n    </div>\r\n    <div class="bd">\r\n        <div class="from-control">\r\n            {{if(it.type == 0){}}\r\n            <div class="input-group">\r\n                <input class="text input" name="money" placeholder="请填写提现金额" value="{{=it.amount}}" />\r\n            </div>\r\n            <div class="input-group">\r\n                <input class="text input" name="name" placeholder="请填写您的姓名" {{?it.name}}value="{{=it.name}}"{{?}} />\r\n            </div>\r\n            <!--<div class="input-group">\r\n                <input class="text input" name="alipay_account" placeholder="请填写您的支付宝账号" {{?it.alipay_account}}value="{{=it.alipay_account}}"{{?}} />\r\n            </div>-->\r\n            <textarea name="alipay_account" placeholder="请填写您的支付宝账号或银行卡号（银行名称、开户行、卡号）" style="height: 88px;">{{?(typeof(it.alipay_account) != \'undefined\' && it.alipay_account != \'undefined\')}}{{=it.alipay_account}}{{?}}</textarea>\r\n            <p class="mb10"><i class="iconfont tint-gray js-remember-btn {{?it.name}}tint-green{{?}}">{{?it.name}}&#xe62f{{}else{}}&#xe62d{{?}}</i> 记住我的姓名和账号</p>\r\n            {{}else{}}\r\n            <div class="input-group">\r\n                <input class="text input" name="money" placeholder="请填写金额" value="{{=it.amount}}" />\r\n            </div>\r\n            {{}}}\r\n            <a class="btn btn-warning btn-big js-cash-apply-btn" style="margin: 0;">申请提现</a>\r\n        </div>\r\n    </div>\r\n</div>'
}), define("apps/newoutlet/views/cash_dialog", ["backbone", "doT", "text!apps/newoutlet/templates/cash_dialog.html"], function(Backbone, doT, Tpl) {
	return Backbone.View.extend({
		className: "pop-dialog",
		template: doT.template(Tpl),
		events: {
			"click .js-close-dialog": "dialogClose",
			"click .js-remember-btn": "rememberSelect",
			"click .js-cash-apply-btn": "apply"
		},
		initialize: function() {},
		render: function(type) {
			this.type = type;
			var amount = parseFloat($(".js-cach-amount").text()).toFixed(2),
				history = localStorage.getItem("Outlet_Alipay_History");
			if (null != history) {
				var objs = eval("(" + history + ")");
				this.$el.html(this.template({
					type: this.type,
					amount: amount,
					name: objs.name,
					alipay_account: objs.alipay_account
				}))
			} else this.$el.html(this.template({
				type: this.type,
				amount: amount
			}));
			return this
		},
		apply: function(e) {
			var t = {
				type: this.type,
				shop_id: _global.shop.id,
				distributor_id: _global.did,
				money: parseFloat($.trim($('input[name="money"]').val()))
			},
				n = this;
			if (t.money <= 0) return void alert("请填写正确金额");
			var s = _global.url.api + "outlet_cash_balance";
			if (0 == t.type) {
				if (t.name = $.trim($('input[name="name"]').val()), t.alipay_account = $.trim($('textarea[name="alipay_account"]').val()), "" == t.name) return void alert("请填写姓名");
				if ("" == t.alipay_account) return void alert("请填写支付宝账号");
				s = _global.url.api + "outlet_cash"
			}
			$(e.currentTarget).text("正在提交..."), this.undelegateEvents(), $.ajax({
				type: "POST",
				url: s,
				data: t,
				success: function(s) {
					console.log(s), $(".js-remember-btn").hasClass("tint-green") ? n.remember({
						name: t.name,
						alipay_account: t.alipay_account
					}) : localStorage.removeItem("Outlet_Alipay_History"), 0 == s.status ? (alert(s.msg), $(e.currentTarget).text("提交"), n.delegateEvents()) : window.location.reload()
				}
			})
		},
		rememberSelect: function(e) {
			$(e.target).hasClass("tint-green") ? ($(e.target).removeClass("tint-green"), $(e.target).html("&#xe62d")) : ($(e.target).addClass("tint-green"), $(e.target).html("&#xe62f"))
		},
		remember: function(e) {
			var t = window.localStorage;
			t.setItem("Outlet_Alipay_History", JSON.stringify(e))
		},
		dialogClose: function() {
			$(".pop-dialog").remove()
		}
	})
}), define("text!apps/newoutlet/templates/money.html", [], function() {
	return '<a style="display: block;" href="/outlet#income">\r\n<header style="height:{{=document.body.clientWidth/2+\'px\'}}">\r\n    <div class="mark-text">可提佣金（元）</div>\r\n    <div class="amount-box clearfix">\r\n        <span class="amount js-cach-amount">{{=it.cash_amount||\'0.00\'}}</span><em class="more-link">查看明细</em>\r\n        <div class="handle-amount">成功提现：{{=it.mentioned_amount||\'0.00\'}}{{?it.handling_amount}}，处理中：{{=it.handling_amount}}元{{?}}</div>\r\n    </div>\r\n</header>\r\n</a>\r\n<section>\r\n    <ul class="list-col2 clearfix">\r\n        <li> <a href="/outlet#income"> <div class="gray f12">累计佣金</div> <div class="f24 black">{{=it.sales_commission||\'0.00\'}}</div> </a> </li>\r\n        <li> <a href="/outlet#income"> <div class="gray f12">未结算佣金</div> <div class="f24 black">{{=parseFloat(it.unsettlement_amount||\'0.00\').toFixed(2)}}</div> </a> </li>\r\n            </ul>\r\n    <div class="amount-mark-text">买家确认收货后，立即获得分销佣金。结算期（<span>{{=it.cash_day||\'7\'}}</span>天）后，佣金可提现。结算期内，买家退货，佣金将自动扣除。</div>\r\n</section>\r\n<section class="apply-box"><button class="btn {{?it.status==\'true\'}}btn-warning js-cash-btn{{?}}">我要提现</button></section>\r\n<div class="new-dialog js-select-cash" style="display: none">\r\n    <div class="bg" onclick="$(\'.js-select-cash\').hide()"></div>\r\n    <div class="body" style="margin-top: -37px;">\r\n        <p class="js-cash-balance">转到余额</p>\r\n        <p class="js-cash-account">提现到账户</p>\r\n    </div>\r\n</div>'
}), define("apps/newoutlet/views/money", ["backbone", "doT", "apps/newoutlet/models/distributor", "apps/newoutlet/models/cash_info", "apps/newoutlet/views/cash_dialog", "text!apps/newoutlet/templates/money.html"], function(e, t, n, s, a, i) {
	var l = $("#views");
	return e.View.extend({
		id: "view-center",
		className: "page-view page-o-amount",
		template: t.template(i),
		events: {
			"click .js-cash-btn": "cash",
			"click .js-cash-account": "cashAccount",
			"click .js-cash-balance": "cashBalance"
		},
		initialize: function() {
			var e = this;
			e.model = new n({
				id: 1
			}), e.listenTo(e.model, "sync", function() {
				e.cashmodel = new s, e.cashmodel.fetch(), e.listenTo(e.cashmodel, "sync", e.render)
			})
		},
		render: function() {
			var e = this.model.toJSON();
			return e.status = this.cashmodel.get("status"), l.html(this.$el.html(this.template(e))), $(".loading").hide(), this
		},
		cash: function() {
			$(".js-select-cash").show()
		},
		cashAccount: function() {
			this.cashDialog(0)
		},
		cashBalance: function() {
			this.cashDialog(1)
		},
		cashDialog: function(e) {
			$(".js-select-cash").hide();
			var t = new a({
				model: this.model
			}),
				n = this;
			$("body").append(t.render(e).$el), t.on("change", function() {
				n.model.fetch()
			})
		}
	})
}), define("apps/newoutlet/models/outlet_customs", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "outlet_customs?shop_id=" + _global.shop.id
		}
	})
}), define("text!apps/newoutlet/templates/center.html", [], function() {
	return '{{var sec_height=document.body.clientWidth/3+\'px\';}}\r\n<div class="header">\r\n    <div class="head-img"><img src="'+window.global_website+'assets/img/wap/outlet/default_head_img.jpg\'}}" alt=""></div>\r\n    <div class="user-info">\r\n        <div class="user-name">{{=_global.member.name||\'\'}}{{?it.lv_count!=0}} <a href="#levels">{{=it.level_name||\'\'}}{{?}}</a> </div>\r\n        <div class="date-time">加入时间：{{=it.dt_add||\'\'}}</div>\r\n    </div>\r\n</div>\r\n<section class="outlet-info" style="height:{{=document.body.clientWidth/2+\'px\'}}">\r\n    <a class="block" href="/outlet#money"><div class="mark-text">累计佣金：{{=it.sales_commission||\'0.00\'}} 元<i class="right iconfont icon-jiantouyou"></i></div>\r\n    <div class="mark-text">可提佣金（元）</div>\r\n    </a>\r\n    <div class="amount-box clearfix"><span class="amount js-cach-amount">{{=it.cash_amount||\'0.00\'}}</span>\r\n        <a class="{{?it.status==\'true\'}}js-cash-btn{{??}}op5{{?}}">提现</a>\r\n    </div>\r\n</section>\r\n<section class="outlet-nav">\r\n    <ul class="clearfix">\r\n        <li style="height: {{=sec_height}}">\r\n            <a href="/outlet#money">\r\n                <span class="iconfont icon-qiandaizi"></span>\r\n                <div class="title">分销佣金</div>\r\n                <div class="desc"><span>{{=it.sales_commission||\'0.00\'}}</span>元</div>\r\n            </a>\r\n        </li>\r\n        <li  style="height: {{=sec_height}}">\r\n            <a href="/outlet#team">\r\n                <span class="iconfont icon-wodekehu"></span>\r\n                <div class="title">我的团队</div>\r\n                <div class="desc"><span>{{=it.sub_number||\'0\'}}</span>个伙伴</div>\r\n            </a>\r\n        </li>\r\n        <li  style="height: {{=sec_height}}">\r\n            <a href="/outlet#order">\r\n                <span class="iconfont icon-fenxiao"></span>\r\n                <div class="title">分销订单</div>\r\n                <div class="desc"><span>{{=it.corder||\'0\'}}</span>个订单</div>\r\n            </a>\r\n        </li>\r\n        <li  style="height: {{=sec_height}}">\r\n            <a href="{{=_global.shop_url}}ad_card/shop{{?_global.shop.stype==1}}?did={{=_global.did}}{{?}}">\r\n                <span class="iconfont icon-yemiantuiguang"></span>\r\n                <div class="title">二维码</div>\r\n                <div class="desc">推广二维码</div>\r\n            </a>\r\n        </li>\r\n        {{?it.is_ranking==\'1\'}}\r\n        <li style="height: {{=sec_height}}">\r\n        <a href="/outlet#ranks">\r\n        <span class="iconfont icon-icon2"></span>\r\n        <div class="title">英雄榜</div>\r\n        <div class="desc">实时佣金排行</div>\r\n        </a>\r\n        </li>\r\n        {{?}}\r\n        {{?it.material_enabled==\'1\'}}\r\n        <li  style="height: {{=sec_height}}">\r\n            <a href="/material">\r\n                <span class="iconfont icon-tuwenxiangqing"></span>\r\n                <div class="title">推广素材</div>\r\n                <div class="desc">分享转发素材</div>\r\n            </a>\r\n        </li>\r\n        {{?}}\r\n        {{~it.icons:menu:index}}\r\n        <li style="height: {{=sec_height}};">\r\n        <a href="{{=menu.url}}">\r\n        <span class="icon-menu"><img src="'+window.global_website+'assets/img/wap/v2/member_my_favicon.jpg\'}}"/> </span>\r\n        <div class="title">{{=menu.name}}</div>\r\n        <div class="desc">{{=menu.description}}</div>\r\n        </a>\r\n        </li>\r\n        {{~}}\r\n    </ul>\r\n</section>\r\n<div class="new-dialog js-select-cash" style="display: none">\r\n    <div class="bg" onclick="$(\'.js-select-cash\').hide()"></div>\r\n    <div class="body" style="margin-top: -37px;">\r\n        <p class="js-cash-balance">转到余额</p>\r\n        <p class="js-cash-account">提现到账户</p>\r\n    </div>\r\n</div>\r\n{{?(_global.shop.stype == \'1\')}}\r\n<footer id="footer-fixed-edit-1">\r\n    <ul class="menu-list">\r\n        <li>\r\n            <a href="{{=_global.shop_url}}?did={{=_global.did}}">\r\n                <i class="iconfont">&#xe615</i>\r\n                <span>微店</span>\r\n            </a>\r\n        </li>\r\n        <li class="active">\r\n            <a>\r\n                <i class="iconfont">&#xe619</i>\r\n                <span>分销中心</span>\r\n            </a>\r\n        </li>\r\n        <li>\r\n            <a href="{{=_global.cart_url}}">\r\n                <i class="iconfont">&#xe624</i>\r\n                <span>购物车</span>\r\n            </a>\r\n        </li>\r\n        <li>\r\n            <a href="{{=_global.my_url}}">\r\n                <i class="iconfont">&#xe623</i>\r\n                <span>我的</span>\r\n            </a>\r\n        </li>\r\n    </ul>\r\n</footer>\r\n{{?}}'
}), define("apps/newoutlet/views/center", ["backbone", "doT", "apps/newoutlet/models/distributor", "apps/newoutlet/models/cash_info", "apps/newoutlet/models/outlet_customs", "apps/newoutlet/views/cash_dialog", "text!apps/newoutlet/templates/center.html"], function(e, t, n, s, a, i, l) {
	var r = $("#views");
	return e.View.extend({
		id: "view-center",
		className: "page-view page-outlet",
		template: t.template(l),
		events: {
			"click .js-cash-btn": "cash",
			"click .js-cash-account": "cashAccount",
			"click .js-cash-balance": "cashBalance"
		},
		initialize: function() {
			var e = this;
			e.model = new n, e.listenTo(e.model, "sync", function() {
				e.cashmodel = new s, e.cashmodel.fetch(), e.listenTo(e.cashmodel, "sync", function() {
					e.iconmodel = new a, e.iconmodel.fetch(), e.listenTo(e.iconmodel, "sync", e.render)
				})
			})
		},
		render: function() {
			var e = this.model.toJSON();
			return e.status = this.cashmodel.get("status"), e.icons = this.iconmodel.get("data"), r.html(this.$el.html(this.template(e))), $(".loading").hide(), this
		},
		cash: function() {
			$(".js-select-cash").show()
		},
		cashAccount: function() {
			this.cashDialog(0)
		},
		cashBalance: function() {
			this.cashDialog(1)
		},
		cashDialog: function(e) {
			$(".js-select-cash").hide();
			var t = new i({
				model: this.model
			}),
				n = this;
			$("body").append(t.render(e).$el), t.on("change", function() {
				n.model.fetch()
			})
		}
	})
}), define("apps/newoutlet/models/cash", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "outlet_cash"
		}
	})
}), define("apps/newoutlet/collections/cash", ["backbone.paginator", "apps/newoutlet/models/cash"], function(e, t) {
	return Backbone.PageableCollection.extend({
		model: t,
		url: _global.url.api + "outlet_cashes",
		state: {
			pagesInRange: 0,
			pageSize: 10,
			sortKey: "dt_add",
			order: 1
		},
		queryParams: {
			totalPages: null,
			totalRecords: null,
			pageSize: "limit",
			currentPage: null,
			offset: function() {
				return (this.state.currentPage - 1) * this.state.pageSize
			},
			did: _global.did,
			shop_id: _global.shop.id
		},
		parseState: function(e) {
			return {
				totalRecords: e._count,
				cashed_money: e.cashed_money
			}
		},
		parseRecords: function(e) {
			return e.data
		}
	})
}), define("text!apps/newoutlet/templates/cash_item.html", [], function() {
	return '<div class="info">\r\n    {{if(it.type == 0){}}\r\n    <p class="f15 mb4">转入账户：{{=it.alipay_account}}</p>\r\n    {{}else{}}\r\n    <p class="f15 mb4">转入商城余额</p>\r\n    {{}}}\r\n    <p class="tint-gray f12">{{=it.dt_apply}}</p>\r\n</div>\r\n<div class="detail">\r\n    {{if(it.type == 0){}}\r\n        {{if(it.status == 0){}}\r\n            <p class="f15 mb4">{{=it.money}}</p>\r\n            <p class="deep-green f12 t_right">处理中</p>\r\n        {{}else if(it.status == 1){}}\r\n            <p class="f15 mb4">{{=it.money}}</p>\r\n            <p class="tint-gray f12 t_right">已打款</p>\r\n        {{}else if(it.status == 2){}}\r\n            <p class="f15 mb4 tint-gray t_lt">{{=it.money}}</p>\r\n            <p class="tint-gray f12 t_right">已取消</p>\r\n        {{}}}\r\n    {{}else{}}\r\n        {{if(it.status == 0){}}\r\n            <p class="f15 mb4">{{=it.money}}</p>\r\n            <p class="deep-green f12 t_right">处理中</p>\r\n        {{}else if(it.status == 1){}}\r\n            <p class="f15 mb4">{{=it.money}}</p>\r\n            <p class="tint-gray f12 t_right">已转入余额</p>\r\n        {{}else if(it.status == 2){}}\r\n            <p class="f15 mb4 tint-gray t_lt">{{=it.money}}</p>\r\n            <p class="tint-gray f12 t_right">已取消</p>\r\n        {{}}}\r\n    {{}}}\r\n</div>'
}), define("apps/newoutlet/views/cash_item", ["backbone", "doT", "text!apps/newoutlet/templates/cash_item.html"], function(e, t, n) {
	return e.View.extend({
		className: "item cash-list",
		template: t.template(n),
		events: {},
		initialize: function() {
			this.listenTo(this.model, "sync", this.render)
		},
		render: function() {
			return this.$el.html(this.template(this.model.toJSON())), this
		}
	})
}), define("text!apps/newoutlet/templates/cash.html", [], function() {
	return '<header class="top-tab">\r\n    <ul class="clearfix">\r\n        <li><a href="/outlet#income">佣金</a></li>\r\n        <li class="on"><a href="/outlet#cash">提现</a></li>\r\n    </ul>\r\n</header>\r\n<div class="js-count"></div>\r\n<div class="bd js-cash-list" style="padding: 0;"></div>'
}), define("apps/newoutlet/views/cash", ["backbone", "doT", "apps/newoutlet/collections/cash", "apps/newoutlet/views/cash_item", "text!apps/newoutlet/templates/cash.html", "text!apps/newoutlet/templates/list_empty.html"], function(e, t, n, s, a, i) {
	var l = $("#views");
	return e.View.extend({
		template: t.template(a),
		className: "page-view page-cash",
		events: {},
		initialize: function() {
			this.collection = new n, this.collection.on("sync", this.renderEach, this)
		},
		render: function() {
			return l.html(this.$el.html(this.template())), this.collection.fetch(), this
		},
		renderEach: function() {
			if (0 == this.collection.state.totalRecords) {
				var e = t.template(i);
				$(".js-cash-list", this.$el).html(e({
					info: "亲，您暂无提现信息！"
				})), $(".js-count", this.$el).html("")
			} else $(".js-count", this.$el).html('<div class="count-text">共<span>' + this.collection.state.totalRecords + "</span>条数据，合计成功提现<span>" + this.collection.state.cashed_money + "</span>元</div>"), this.collection.each(this.renderItem, this), this.bottomLoad();
			$(".loading").hide()
		},
		renderItem: function(e) {
			$(".js-cash-list", this.$el).append(new s({
				model: e
			}).render().$el)
		},
		bottomLoad: function() {
			var e = this;
			$(window).scroll(function() {
				var t = $(this).scrollTop(),
					n = $(document).height(),
					s = $(this).height();
				t + s == n && e.collection.hasNextPage() && e.collection.getNextPage({
					reset: !0
				})
			})
		}
	})
}), define("apps/newoutlet/collections/income", ["backbone.paginator", "apps/newoutlet/models/cash"], function(e, t) {
	return Backbone.PageableCollection.extend({
		model: t,
		url: _global.url.api + "outlet_cash_income?did=" + _global.did,
		state: {
			pagesInRange: 0,
			pageSize: 10,
			sortKey: "dt_add",
			order: 1
		},
		queryParams: {
			totalPages: null,
			totalRecords: null,
			pageSize: "limit",
			currentPage: null,
			offset: function() {
				return (this.state.currentPage - 1) * this.state.pageSize
			},
			did: _global.did,
			shop_id: _global.shop.id
		},
		parseState: function(e) {
			return {
				totalRecords: e._count,
				total_commission: e.total_commission
			}
		},
		parseRecords: function(e) {
			return e.data
		}
	})
}), define("text!apps/newoutlet/templates/income_item.html", [], function() {
	return '<div class="info">\r\n    <p class="f15 mb4">\r\n        {{?it.dlevel==\'1\'}}一级订单：\r\n        {{??it.dlevel==\'2\'}}\r\n        二级订单：\r\n        {{??it.dlevel==\'3\'}}\r\n        三级订单：\r\n        {{?}}\r\n        {{=it.order_sn}}</p>\r\n    <p class="tint-gray f12">{{=it.dt_add}}</p>\r\n</div>\r\n<div class="detail">\r\n    {{if(it.status == 0){}}\r\n    <p class="tint-gray f15 mb4">+{{=it.commission}}</p>\r\n    {{}else{}}\r\n    <p class="deep-green f15 mb4">+{{=it.commission}}</p>\r\n    {{}}}\r\n    {{if(it.status == 0){}}\r\n        <p class="tint-gray f12 t_right">未结算</p>\r\n    {{}else{}}\r\n        <p class="tint-gray f12 t_right">已结算</p>\r\n    {{}}}\r\n</div>'
}), define("apps/newoutlet/views/income_item", ["backbone", "doT", "text!apps/newoutlet/templates/income_item.html"], function(e, t, n) {
	return e.View.extend({
		className: "item cash-list",
		template: t.template(n),
		events: {},
		initialize: function() {
			this.listenTo(this.model, "sync", this.render)
		},
		render: function() {
			return this.$el.html(this.template(this.model.toJSON())), this
		}
	})
}), define("text!apps/newoutlet/templates/income.html", [], function() {
	return '<header class="top-tab">\r\n    <ul class="clearfix">\r\n        <li class="on"><a href="/outlet#income">佣金</a></li>\r\n        <li><a href="/outlet#cash">提现</a></li>\r\n    </ul>\r\n</header>\r\n<div class="js-count"></div>\r\n<div class="bd js-cash-list" style="padding: 0;"></div>'
}), define("apps/newoutlet/views/income", ["backbone", "doT", "apps/newoutlet/collections/income", "apps/newoutlet/views/income_item", "text!apps/newoutlet/templates/income.html", "text!apps/newoutlet/templates/list_empty.html"], function(e, t, n, s, a, i) {
	var l = $("#views");
	return e.View.extend({
		template: t.template(a),
		className: "page-view page-cash",
		events: {},
		initialize: function() {
			this.collection = new n, this.collection.on("sync", this.renderEach, this)
		},
		render: function() {
			return l.html(this.$el.html(this.template())), this.collection.fetch(), this
		},
		renderEach: function() {
			if (0 == this.collection.state.totalRecords) {
				var e = t.template(i);
				$(".js-cash-list", this.$el).html(e({
					info: "亲，您暂无收入信息！"
				})), $(".js-count", this.$el).html("")
			} else $(".js-count", this.$el).html('<div class="count-text">共<span>' + this.collection.state.totalRecords + "</span>条数据，合计佣金<span>" + this.collection.state.total_commission + "</span>元</div>"), this.collection.each(this.renderItem, this), this.bottomLoad();
			$(".loading").hide()
		},
		renderItem: function(e) {
			$(".js-cash-list", this.$el).append(new s({
				model: e
			}).render().$el)
		},
		bottomLoad: function() {
			var e = this;
			$(window).scroll(function() {
				var t = $(this).scrollTop(),
					n = $(document).height(),
					s = $(this).height();
				t + s == n && e.collection.hasNextPage() && e.collection.getNextPage({
					reset: !0
				})
			})
		}
	})
}), define("apps/newoutlet/collections/outlet_ranks", ["backbone.paginator", "apps/newoutlet/models/cash"], function(e, t) {
	return Backbone.PageableCollection.extend({
		model: t,
		url: _global.url.api + "outlet_ranks?shop_id=" + _global.shop.id + "did=" + _global.did,
		state: {
			pagesInRange: 0,
			pageSize: 1,
			sortKey: "dt_add",
			order: 1
		},
		queryParams: {
			totalPages: null,
			totalRecords: null,
			pageSize: "limit",
			currentPage: null,
			offset: function() {
				return (this.state.currentPage - 1) * this.state.pageSize
			},
			did: _global.did,
			shop_id: _global.shop.id
		},
		parseState: function(e) {
			return {
				current_income_amount: e.current_income_amount,
				current_listorder: e.current_listorder
			}
		},
		parseRecords: function(e) {
			return e.data
		}
	})
}), define("apps/newoutlet/collections/month_ranks", ["backbone.paginator", "apps/newoutlet/models/cash"], function(e, t) {
	return Backbone.PageableCollection.extend({
		model: t,
		url: _global.url.api + "month_ranks?shop_id=" + _global.shop.id + "did=" + _global.did,
		state: {
			pagesInRange: 0,
			pageSize: 1,
			sortKey: "dt_add",
			order: 1
		},
		queryParams: {
			totalPages: null,
			totalRecords: null,
			pageSize: "limit",
			currentPage: null,
			offset: function() {
				return (this.state.currentPage - 1) * this.state.pageSize
			},
			did: _global.did,
			shop_id: _global.shop.id
		},
		parseState: function(e) {
			return {
				current_income_amount: e.current_income_amount,
				current_listorder: e.current_listorder
			}
		},
		parseRecords: function(e) {
			return e.data
		}
	})
}), define("apps/newoutlet/collections/commission1_ranks", ["backbone.paginator", "apps/newoutlet/models/cash"], function(e, t) {
	return Backbone.PageableCollection.extend({
		model: t,
		url: _global.url.api + "outlet_commission1_ranks?shop_id=" + _global.shop.id + "did=" + _global.did,
		state: {
			pagesInRange: 0,
			pageSize: 1,
			sortKey: "dt_add",
			order: 1
		},
		queryParams: {
			totalPages: null,
			totalRecords: null,
			pageSize: "limit",
			currentPage: null,
			offset: function() {
				return (this.state.currentPage - 1) * this.state.pageSize
			},
			did: _global.did,
			shop_id: _global.shop.id
		},
		parseState: function(e) {
			return {
				current_income_amount: e.current_income_amount,
				current_listorder: e.current_listorder
			}
		},
		parseRecords: function(e) {
			return e.data
		}
	})
}), define("text!apps/newoutlet/templates/ranks_item.html", [], function() {
	return '<span class="num"><b>{{=it.rank}}</b></span>\r\n<span class="header-pic"><img src="'+window.global_website+'assets/img/wap/outlet/default_head_img.jpg\'}}" alt=""></span>\r\n           <span class="nickname">\r\n               <div>{{=it.name}}</div>\r\n               <div class="desc">{{=it.sub_number}}个伙伴</div>\r\n           </span>\r\n<span class="price">￥{{=it.sales_commission||\'0.00\'}}</span>\r\n'
}), define("apps/newoutlet/views/ranks_item", ["backbone", "doT", "text!apps/newoutlet/templates/ranks_item.html"], function(e, t, n) {
	return e.View.extend({
		className: "clearfix",
		tagName: "li",
		template: t.template(n),
		events: {},
		initialize: function() {
			this.listenTo(this.model, "sync", this.render)
		},
		render: function() {
			return this.model.get("name") == _global.member.name && this.$el.addClass("on"), this.$el.html(this.template(this.model.toJSON())), this
		}
	})
}), define("text!apps/newoutlet/templates/ranks.html", [], function() {
	return '<header><img src="'+window.global_website+'assets/img/wap/outlet/top_header.jpg" width="100%" alt=""></header>\r\n        <div class="ranks-tab">\r\n            <ul class="clearfix">\r\n                <li class="on js-month"><a>当月排名</a></li>\r\n                <li class="js-all"><a>总排名</a></li>\r\n                <!-- <li class="js-shop"><a>店铺排名</a></li> -->\r\n            </ul>\r\n        </div>\r\n<div class="top-title js-title"></div>\r\n<ul class="member-list js-ranks-list"></ul>'
}), define("apps/newoutlet/views/ranks", ["backbone", "doT", "apps/newoutlet/collections/outlet_ranks", "apps/newoutlet/collections/month_ranks", "apps/newoutlet/collections/commission1_ranks", "apps/newoutlet/views/ranks_item", "components/pager/main", "text!apps/newoutlet/templates/ranks.html"], function(e, t, n, s, a, i, l, r) {
	var o = $("#views");
	return e.View.extend({
		template: t.template(r),
		className: "page-top",
		events: {
			"click .js-month": "rank_month",
			"click .js-all": "rank_all",
			"click .js-shop": "rank_shop"
		},
		initialize: function() {
			this.collection = new s, this.collection.on("sync", this.renderEach, this)
		},
		render: function() {
			return o.html(this.$el.html(this.template())), this.collection.fetch(), this
		},
		rank_month: function(e) {
			$(".loading").show(), $(e.currentTarget).siblings().removeClass("on"), $(e.currentTarget).addClass("on"), $(".js-ranks-list", this.$el).html(""), this.collection = new s, this.collection.on("sync", this.renderEach, this), this.collection.fetch()
		},
		rank_all: function(e) {
			$(".loading").show(), $(e.currentTarget).siblings().removeClass("on"), $(e.currentTarget).addClass("on"), $(".js-ranks-list", this.$el).html(""), this.collection = new n, this.collection.on("sync", this.renderEach, this), this.collection.fetch()
		},
		rank_shop: function(e) {
			$(".loading").show(), $(e.currentTarget).siblings().removeClass("on"), $(e.currentTarget).addClass("on"), $(".js-ranks-list", this.$el).html(""), this.collection = new a, this.collection.on("sync", this.renderEach, this), this.collection.fetch()
		},
		renderEach: function() {
			if (0 == this.collection.state.totalRecords) $(".js-title", this.$el).html("");
			else {
				var e = 0 == this.collection.state.current_income_amount ? "-" : this.collection.state.current_listorder;
				$(".js-title", this.$el).html("<div>我的佣金<span>" + this.collection.state.current_income_amount + "</span>元，当前排名：<span>" + e + "</span></div>"), this.collection.each(function(e, t) {
					e.set("index", t + 1), $(".js-ranks-list", this.$el).append(new i({
						model: e
					}).render().$el)
				})
			}
			$(".loading").hide()
		}
	})
}), define("apps/newoutlet/models/outlet_levels", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "outlet_levels?shop_id=" + _global.shop.id
		}
	})
}), define("text!apps/newoutlet/templates/outlet_levels.html", [], function() {
	return '<link rel="stylesheet" type="text/css" href="'+window.global_website+'assets/css/wap/v2/outlet_levels.css">\r\n<ul class="header">\r\n        <li class="header1">\r\n            <div class="logo" ><img src=\'{{=_global.member.avatar}}\'/></div>\r\n            <div class="level f12">Lv.3</div>\r\n        </li>\r\n        <li class="header2 f16">你好，{{=_global.member.name}}</li>\r\n        <li class="header3 f14">\r\n            您的佣金：\r\n            <span class="deep-yellow">￥1850.00</span>\r\n            ，离升级还差\r\n            <span class="deep-yellow">￥1150.00</span>\r\n        </li>\r\n        <li class="header4">\r\n            <span  class="white font-weight800">我的佣金增幅：<span class="deep-yellow">1.5倍</span></span>\r\n        </li>\r\n        <li class="header5">\r\n            <span class="t_center Uniform f16 deep-yellow">\r\n            15</br><span class="lh white">一级佣金 </span>\r\n            </span>\r\n            <span class="t_center Uniform f16 wborder deep-yellow">\r\n            7.5</br><span class="lh white">二级佣金 </span>\r\n            </span>\r\n            <span class=" Uniform f16 wborder t_center deep-yellow">\r\n            1.5</br><span class="lh white">三级佣金 </span>\r\n            </span>\r\n        </li>\r\n    </ul>\r\n\r\n    <div class="progress">\r\n        {{if(it.data.length==0){}}\r\n        <div id="round" class="roundb round " ><span id="bround"  class="bround f16 gray">LV.1</span> </div>\r\n        {{}}}\r\n        {{for(var i in it.data){}}\r\n        <div id="round" class="roundb round" data-id="{{=it.data[i].id}}"><span id="bround" data-id="{{=it.data[i].id}}" class="bround f16 gray">LV.{{=parseInt(i)+1}}</span> </div>\r\n\r\n        {{if( it.data.length>parseInt(i)+1){}}\r\n\r\n        <div class="round">\r\n            <span class="sround"></span>\r\n            <span class="sround"></span>\r\n            <span class="sround"></span>\r\n            <span class="sround"></span>\r\n        </div>\r\n        {{}}}\r\n        {{}}}\r\n    </div>\r\n    <div id=\'all\'></div>\r\n  <div class="bg">\r\n       <div class="dialog">\r\n           <p>什么是佣金增幅？</p>\r\n           <span>为了更好的鼓励分销商们拓展业务，商家为不同能力的分销商设置了不同的佣金比例。让能力好的分销商能够获得更多的佣金。\r\n           以{{=it.data[0].name}}的佣金比例为基准线，设置佣金增幅（N倍），佣金增幅按照倍数设置。\r\n           其他分销商等级的佣金比例={{=it.data[0].name}}的佣金比例×倍数。</span>\r\n           <div class="helpbtn">好的，知道了</div>\r\n       </div>\r\n   </div> '
}), define("apps/newoutlet/models/outlet_level", ["backbone"], function(e) {
	return e.Model.extend({
		url: function() {
			return _global.url.api + "outlet_level?shop_id=" + _global.shop.id + "&id=" + this.id
		}
	})
}), define("text!apps/newoutlet/templates/outlet_level.html", [], function() {
	return '\r\n<p class="item f16 " style="border: 0px;">\r\n        Lv.{{=it.lv_num}}： {{=it.name}}\r\n</p>\r\n<!-- <div class="item">\r\n        <span class="bold  font-weight800">佣金增幅：<span><span class="deep-red">{{=it.increase}}倍</span>\r\n        <div class="whybtn"><span class="question">?</span>什么是佣金增幅</div>\r\n    </div> -->\r\n    <p class="item">\r\n        <span class="t_center Uniform f16 deep-orange">\r\n            {{=it.lv1}}%</br><span class="lh gray">一级佣金 </span>\r\n        </span>\r\n        <span class="t_center Uniform f16 gborder deep-orange">\r\n            {{=it.lv2}}%</br><span class="lh gray">二级佣金 </span>\r\n        </span>\r\n        <span class=" Uniform f16 gborder t_center deep-orange">\r\n            {{=it.lv3}}%</br><span class="lh gray">三级佣金 </span>\r\n        </span>\r\n    </p>\r\n    <p class="item">\r\n        <span class="f16 tint-black bold font-weight800" style="display: block;">等级说明:</span>\r\n        <span class="f12 gray">\r\n        {{=it.description}}\r\n        </span>\r\n    </p>\r\n'
}), define("apps/newoutlet/views/level", ["backbone", "doT", "apps/newoutlet/models/outlet_level", "text!apps/newoutlet/templates/outlet_level.html"], function(e, t, n, s) {
	$("#all");
	return e.View.extend({
		template: t.template(s),
		events: {},
		initialize: function() {
			this.model = new n({
				id: this.id
			})
		},
		render: function(e, t) {
			var n = this;
			return 0 == e ? this.model.fetch({
				success: function() {
					$("#all").html(n.$el.html(n.template(n.model.toJSON())))
				}
			}) : $("#all").html(n.$el.html(n.template(t))), this
		}
	})
}), define("apps/newoutlet/views/levels", ["backbone", "doT", "apps/newoutlet/models/outlet_levels", "text!apps/newoutlet/templates/outlet_levels.html", "apps/newoutlet/views/level"], function(e, t, n, s, a) {
	var i = $("#views");
	return e.View.extend({
		template: t.template(s),
		events: {
			"click .bround": "round",
			"click .whybtn": "showhelp",
			"click .helpbtn": "hidehelp"
		},
		initialize: function() {
			this.model = new n
		},
		render: function() {
			var e = this;
			return this.model.fetch({
				success: function() {
					i.html(e.$el.html(e.template(e.model.toJSON()))), $(".loading").hide(), e.getmydata(), $("#views").css("overflow", "hidden")
				}
			}), this
		},
		round: function(e) {
			if ($(".bround").length > 1) {
				$("#roundimg").remove(), $(e.target).parent().append("<img id='roundimg' src='" +window.global_website+ "assets/img/wap/triangle.jpg'/> "), $(".bround").removeClass("orange"), $(e.target).addClass("orange");
				var t = new a({
					id: $(e.target).attr("data-id")
				});
				t.render(0)
			}
		},
		roundnew: function(e) {
			$($(".roundb")[e - 1]).append("<img id='roundimg' src='" +window.global_website+ "assets/img/wap/triangle.jpg'/>"), $($(".bround")[e - 1]).addClass("orange");
			var t = new a({
				id: $($(".bround")[e - 1]).attr("data-id")
			});
			0 == this.model.get("_count") ? t.render(1, this.model.get("default_data")) : t.render(0)
		},
		getmydata: function() {
			var e = this;
			$.ajax({
				type: "GET",
				async: !1,
				url: _global.url.api + "distributor_new",
				data: {
					shop_id: _global.shop.id
				},
				dataType: "json",
				success: function(t) {
					$(".header5").html("<span class=' t_center Uniform f16 deep-yellow'>" + +t.lv1 + "%</br><span class='lh white'>一级佣金 </span></span><span class=' wborder t_center Uniform f16 deep-yellow'>" + +t.lv2 + "%</br><span class='lh white'>二级佣金 </span></span><span class='wborder t_center Uniform f16 deep-yellow'>" + +t.lv3 + "%</br><span class='lh white'>三级佣金 </span></span>"), 0 == t.level_type ? ($(".header4").html("<span  class='bold font-weight800 white'>我的佣金比例：</span>"), $(".level").html("Lv." + t.lv_num), $(".header3").html(0 == t.lv_highest ? "您的佣金：<span class='deep-yellow'>￥" + t.sales_commission + "</span>，离升级还差<span class='deep-yellow'>￥" + t.margin_commission + "</span>" : "您的佣金：<span class='deep-yellow'>￥" + t.sales_commission + "</span>,您已达到巅峰。")) : ($(".level").html("特"), $(".header4").html("<span  class='bold font-weight800 white '>我的佣金比例(特)：</span>"), $(".header3").html("您的特权有效期至：" + t.lose_time)), e.roundnew(t.lv_num)
				}
			})
		},
		showhelp: function() {
			$(".bg").show(), $(".helpbtn").show()
		},
		hidehelp: function() {
			$(".bg").hide(), $(".helpbtn").hide()
		}
	})
}), define("apps/newoutlet/router", ["backbone", "core/common", "apps/newoutlet/models/apply", "apps/newoutlet/views/apply", "apps/newoutlet/views/order", "apps/newoutlet/views/team", "apps/newoutlet/views/money", "apps/newoutlet/views/center", "apps/newoutlet/views/cash", "apps/newoutlet/views/income", "apps/newoutlet/views/ranks", "apps/newoutlet/views/levels"], function(e, t, n, s, a, i, l, r, o, c, d, p) {
	var u = e.Router.extend({
		routes: {
			"": "index",
			center: "center",
			team: "team",
			order: "order",
			money: "money",
			cash: "cash",
			income: "income",
			ranks: "ranks",
			levels: "levels"
		},
		index: function() {
			var e = new s;
			e.model.fetch()
		},
		center: function() {
			this.check();
			var e = new r;
			e.model.fetch()
		},
		order: function() {
			$(".loading").show(), this.check();
			var e = new a;
			e.render()
		},
		money: function() {
			$(".loading").show(), this.check();
			var e = new l;
			e.model.fetch()
		},
		team: function() {
			$(".loading").show(), this.check();
			var e = new i;
			e.render()
		},
		cash: function() {
			$(".loading").show(), this.check();
			var e = new o;
			e.render()
		},
		income: function() {
			$(".loading").show(), this.check();
			var e = new c;
			e.render()
		},
		ranks: function() {
			$(".loading").show(), this.check();
			var e = new d;
			e.render()
		},
		levels: function() {
			$(".loading").show(), this.check();
			var e = new p;
			e.render()
		},
		check: function() {
			return "undefined" == typeof _global.did || 0 == _global.did ? (window.location.href = _global.url.base, !1) : (this.model = new n, void this.model.fetch({
				success: function(t, n) {
					return 1001 == n.code ? n : void e.history.navigate("", {
						trigger: !0
					})
				},
				fail: function() {}
			}))
		}
	});
	new u, e.history.start()
});