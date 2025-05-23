(function () {
    var a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s = {}.hasOwnProperty,
        t = function (a, b) {
            function c() {
                this.constructor = a
            }
            for (var d in b) s.call(b, d) && (a[d] = b[d]);
            return c.prototype = b.prototype, a.prototype = new c, a.__super__ = b.prototype, a
        };
    if (p = "https://js.stripe.com", h = "https://js.stripe.com", j = !!/stripe\.com$/.test("undefined" != typeof window && null !== window ? window.location.host : void 0), i = /MSIE 9/i.test(navigator.userAgent), g = "console" in window && "warn" in window.console, f = function () {
            var a;
            return (null != (a = window.performance) && "function" == typeof a.now ? a.now() : void 0) || ("function" == typeof Date.now ? Date.now() : void 0) || +new Date
        }, o = f(), m = {}, !j && "querySelectorAll" in document && g && (n = document.querySelectorAll('script[src^="' + p + '"]'), n.length || console.warn("It looks like Stripe.js is not being loaded from https://js.stripe.com. Stripe does not support serving Stripe.js from your own domain.")), a = function () {
            function a() {
                if (a.StripeV3) return a.StripeV3.apply(a, arguments)
            }
            return a.version = 2, a.endpoint = "https://api.stripe.com/v1", a.StripeV3 = null, a.setPublishableKey = function (b) {
                var c, d;
                if (a.key = b, a.utils.validateProtocol(a.key), d = /^pk_test_/.test(a.key), i && d && !a.acknowledgeIE9Deprecation) throw c = "Starting in December 2018, stripe.js v2 and Checkout will no longer support IE9, per Microsoft's lifecycle policy\n\nThis error is being thrown only in IE9 in testmode so that you have an opportunity to update your integration or your browser testing strategy.\n\nIf you want to suppress this error in testmode until December, you can add:\n  Stripe.acknowledgeIE9Deprecation = true\nbefore you call Stripe.setPublishableKey", g && console.warn(c), new Error(c)
            }, a._language = "en-US", a.setLanguage = function (b) {
                return a._language = b
            }, a._allowedCustomHeaders = ["X-Stripe-Livemode", "Authorization"], a._customHeaders = {}, a._setCustomHeader = function (a, b) {
                var c, d, e, f, g;
                for (d = !1, g = this._allowedCustomHeaders, e = 0, f = g.length; e < f; e++)
                    if (c = g[e], c === a) {
                        this._customHeaders[a] = b, d = !0;
                        break
                    } return d
            }, a.trackPerf = !1, a._isChannel = "#__stripe_transport__" === ("undefined" != typeof window && null !== window ? window.location.hash : void 0), a._isSafeStripeDomain = j, a._iframeOnAmount = 1, a._isSafeDomain = function () {
                return "#__forcedss3__" !== window.location.hash && (!(!a._isSafeStripeDomain && !window.StripeTemporaryNoDSS3) || a._iframeOnAmount < Math.random())
            }(), a._finalTransport = "cors", a._transport = a._isChannel || a._isSafeDomain ? a._finalTransport : "iframe", a._fallBackToOldStripeJsTechniques = function () {
                return this._transport = this._finalTransport, this._isSafeDomain = "true"
            }, a._iframeRequestQueue = [], a._iframePendingRequests = {}, a._iframeChannelStatus = "pending", a._iframeChannelComplete = function (b) {
                var c, d, e, f;
                for (this._iframeChannelStatus = b ? "success" : "failure", "failure" === this._iframeChannelStatus && this._fallBackToOldStripeJsTechniques(), d = this._iframeRequestQueue, delete this._iframeRequestQueue, this._iframeRequestQueue = [], e = 0, f = d.length; e < f; e++) c = d[e], this.request(c, !0);
                this._iframeChannelComplete = function () {
                    return a.reportError("CompleteDuplicationError")
                }
            }, a.request = function (a, b) {
                return this.trackPerf && a.tokenType ? this._instrumentedRequest(a, b) : this._rawRequest(a, b)
            }, a._rawRequest = function (b, c) {
                var d, e, f;
                if (b.data || (b.data = {}), e = "POST" === b.method && "object" == typeof (null != (f = b.data) ? f.card : void 0), c || (null != b.data.payment_user_agent ? this._isChannel || (b.data.payment_user_agent = "" + b.data.payment_user_agent + " (" + a.stripejs_ua + ")") : b.data.payment_user_agent = a.stripejs_ua), "iframe" === this._transport) {
                    if (e) return "pending" === this._iframeChannelStatus ? this._iframeRequestQueue.push(b) : "failure" === this._iframeChannelStatus ? (this._fallBackToOldStripeJsTechniques(), this.request(b, !0)) : this.iframe(b);
                    if ("cors" === this._finalTransport) return this.xhr(b)
                } else if ("cors" === this._transport) try {
                    return this.xhr(b)
                } catch (g) {
                    throw d = g, a.reportError("XhrThrewError"), d
                }
            }, a.reportError = function (b, c) {
                var d;
                return "console" in window && "warn" in window.console, 1, d = Math.round((new Date).getTime() / 1e3), (new Image).src = "https://q.stripe.com?event=stripejs-error&type=" + encodeURIComponent(b) + (c ? "&timing=" + c : "") + "&key=" + a.key + "&timestamp=" + d + "&payment_user_agent=" + encodeURIComponent(a.stripejs_ua)
            }, a._instrumentedRequest = function (b, c) {
                var d, e;
                return d = (new Date).getTime(), e = function (c) {
                    return function (e, f) {
                        var g, h, i, j, k;
                        return j = null != (k = b.tokenType) ? k : "unknown", g = (new Date).getTime(), h = c._getResourceTiming(null != e ? e.responseURL : void 0), i = {
                            event: "rum.stripejs",
                            tokenType: j,
                            url: b.url,
                            status: f,
                            start: d,
                            end: g,
                            resourceTiming: h
                        }, a.logRUM(i)
                    }
                }(this), b.success = function (a) {
                    return function (b, c, d) {
                        return e(d, c), a.apply(this, arguments)
                    }
                }(b.success), b.complete = function (a) {
                    return function (b, c, d) {
                        return "success" !== b && e(c, b), a.apply(this, arguments)
                    }
                }(b.complete), this._rawRequest(b, c)
            }, a._getResourceTiming = function (a) {
                var b;
                switch (b = "undefined" != typeof performance && null !== performance && "function" == typeof performance.getEntriesByName ? performance.getEntriesByName(a) : void 0, !1) {
                    case 1 !== (null != b ? b.length : void 0):
                        return this._sanitizeResourceTiming(b[0]);
                    case 0 !== (null != b ? b.length : void 0):
                        return {
                            errorMsg: "No resource timing entries found"
                        };
                    case null == (null != b ? b.length : void 0):
                        return {
                            errorMsg: "More than one resource timing entry"
                        };
                    default:
                        return null
                }
            }, a._resourceTimingWhitelist = ["connectEnd", "connectStart", "domainLookupEnd", "domainLookupStart", "duration", "fetchStart", "redirectEnd", "redirectStart", "requestStart", "responseEnd", "responseStart", "secureConnectionStart", "startTime"], a._sanitizeResourceTiming = function (a) {
                var b, c, d, e, f;
                for (c = {}, f = this._resourceTimingWhitelist, d = 0, e = f.length; d < e; d++) b = f[d], a[b] && (c[b] = a[b]);
                return c
            }, a.logRUM = function (b) {
                return (new Image).src = "https://q.stripe.com/?" + a.utils.serialize(b)
            }, a.complete = function (b, c) {
                return function (d, e, f) {
                    if ("success" !== d) return a.reportError("Complete500-" + d), "function" == typeof b ? b(500, {
                        error: {
                            code: d,
                            type: d,
                            message: c
                        }
                    }) : void 0
                }
            }, a._iframeBaseUrl = h, a._stripejsBaseUrl = p, a._relayResponse = function (b, c, d) {
                return a._socket.postMessage(a.JSON.stringify({
                    code: c,
                    resp: d,
                    requestId: b
                }))
            }, a._callCount = 0, a._callCache = {}, a._receiveChannelRelay = function (b, c) {
                var d, e, f, g;
                if (f = a._iframeBaseUrl.replace(/^https?:\/\//, "").replace(/\/.*$/, ""), g = c.replace(/^https?:\/\//, "").replace(/\/.*$/, ""), g === f && "string" == typeof b) {
                    try {
                        e = a.JSON.parse(b)
                    } catch (h) {
                        throw d = h, a.reportError("InvalidJSON-ChannelRelay"), new Error("Stripe.js received invalid JSON")
                    }
                    if ("function" == typeof a._callCache[e.requestId]) return a._callCache[e.requestId](e.resp, e.code), delete a._callCache[e.requestId]
                }
            }, a._channelListener = function (b, c) {
                var d, e, f, g, h;
                if ("string" == typeof b) {
                    try {
                        g = a.JSON.parse(b)
                    } catch (i) {
                        throw e = i, a.reportError("InvalidJSON-ChannelListener"), new Error("Stripe.js received invalid JSON")
                    }
                    if (d = g.data.card, f = g.headers["Accept-Language"], h = g.headers["Stripe-Account"], d) return a.setPublishableKey(g.data.key), f && a.setLanguage(f), null != g.endpoint && a._validateEndpoint(g.endpoint) && (a.endpoint = g.endpoint), null != g.trackPerf && (a.trackPerf = g.trackPerf), "card" === g.data.type ? (h && (a.source.stripeAccount = h), a.source.create(g.data, function (b, c) {
                        return a._relayResponse(g.requestId, b, c)
                    })) : (delete g.data.card, a.card.createToken(d, g.data, function (b, c) {
                        return a._relayResponse(g.requestId, b, c)
                    }));
                    throw a.reportError("InvalidChannelUse-NonCard"), new Error("Stripe.js iframe transport used for non-card request")
                }
            }, a._validateEndpoint = function (a) {
                var b;
                return b = document.createElement("a"), b.href = a, ("http:" === b.protocol || "https:" === b.protocol) && !!b.hostname.match(/^(qa-|edge-)?api\.stripe\.com$/)
            }, a
        }(), this.Stripe) {
        if (3 !== this.Stripe.version) return !g || this.Stripe.isDoubleLoaded || this.Stripe.earlyError || console.warn("It looks like Stripe.js was loaded more than one time. Please only load it once per page."), void(this.Stripe.isDoubleLoaded = !0);
        a.StripeV3 = this.Stripe
    }
    for (this.Stripe = a, this.Stripe.token = function () {
            function b() {}
            return b.validate = function (a, b) {
                if (!a) throw b + " required";
                if ("object" != typeof a) throw b + " invalid"
            }, b.formatData = function (b, c) {
                var d, e, f;
                a.utils.isElement(b) && (b = a.utils.paramsFromForm(b, c));
                for (d in b) e = b[d], null == e && delete b[d];
                if (a.utils.underscoreKeys(b), "string" == typeof b.exp) {
                    try {
                        f = a.utils.parseExpString(b.exp), b.exp_month = f[0], b.exp_year = f[1]
                    } catch (g) {
                        b.exp_month = 0, b.exp_year = 0
                    }
                    delete b.exp
                }
                return b
            }, b.create = function (b, c) {
                var d, e;
                return b.key || (b.key = a.key || a.publishableKey), a.utils.validateKey(b.key), e = function () {
                    switch (!1) {
                        case null == b.card:
                            return "card";
                        case null == b.bank_account:
                            return "bank_account";
                        case null == b.pii:
                            return "pii";
                        case null == b.apple_pay:
                            return "apple_pay";
                        default:
                            return "unknown"
                    }
                }(), delete b.apple_pay, d = {
                    url: "" + a.endpoint + "/tokens",
                    data: b,
                    method: "POST",
                    headers: {},
                    success: function (a, b) {
                        return "function" == typeof c ? c(b, a) : void 0
                    },
                    complete: a.complete(c, "A network error has occurred, and you have not been charged. Please try again."),
                    timeout: 4e4,
                    tokenType: e
                }, a._language && (d.headers["Accept-Language"] = a._language), a.request(d)
            }, b.get = function (b, c) {
                if (!b) throw new Error("token required");
                return a.utils.validateKey(a.key), a.request({
                    url: "" + a.endpoint + "/tokens/" + b,
                    data: {
                        key: a.key
                    },
                    success: function (a, b) {
                        return "function" == typeof c ? c(b, a) : void 0
                    },
                    complete: a.complete(c, "A network error has occurred loading data from Stripe. Please try again."),
                    timeout: 4e4
                })
            }, b
        }(), this.Stripe.card = function (b) {
            function c() {
                return c.__super__.constructor.apply(this, arguments)
            }
            return t(c, b), c.tokenName = "card", c.whitelistedAttrs = ["number", "cvc", "exp", "exp_month", "exp_year", "name", "address_line1", "address_line2", "address_city", "address_state", "address_zip", "address_country", "currency"], c.createToken = function (b, d, e) {
                var g, h, i;
                if (null == d && (d = {}), a.token.validate(b, "card"), "function" == typeof d ? (e = d, d = {}) : "object" != typeof d && (g = parseInt(d, 10), d = {}, g > 0 && (d.amount = g)), b._fields && b.createToken) return b.createToken(e);
                d[c.tokenName] = a.token.formatData(b, c.whitelistedAttrs), d.time_on_page = Math.round(f() - o);
                try {
                    i = Object.keys(m), i.length > 0 && (d.pasted_fields = i.sort().join(","))
                } catch (j) {
                    h = j
                }
                return d = a.utils.addAdditionalParams(d), a.token.create(d, e)
            }, c.getToken = function (b, c) {
                return a.token.get(b, c)
            }, c.validateCardNumber = function (a) {
                return a = (a + "").replace(/\s+|-/g, ""), a.length >= 10 && a.length <= 16 && c.luhnCheck(a)
            }, c.validateCVC = function (b) {
                return b = a.utils.trim(b), /^\d+$/.test(b) && b.length >= 3 && b.length <= 4
            }, c.validateExpiry = function (b, c) {
                var d, e, f, g;
                if (null != c) f = a.utils.trim(b), c = a.utils.trim(c);
                else {
                    try {
                        g = a.utils.parseExpString(b), f = g[0], c = g[1]
                    } catch (h) {
                        return !1
                    }
                    f += "", c += ""
                }
                return !!/^\d+$/.test(f) && (!!/^\d+$/.test(c) && (1 <= f && f <= 12 && (2 === c.length && (c = c < 70 ? "20" + c : "19" + c), 4 === c.length && (e = new Date(c, f), d = new Date, e.setMonth(e.getMonth() - 1), e.setMonth(e.getMonth() + 1, 1), e > d))))
            }, c.luhnCheck = function (a) {
                var b, c, d, e, f, g;
                for (d = !0, e = 0, c = (a + "").split("").reverse(), f = 0, g = c.length; f < g; f++) b = c[f], b = parseInt(b, 10), (d = !d) && (b *= 2), b > 9 && (b -= 9), e += b;
                return e % 10 === 0
            }, c.cardType = function (a) {
                return c.cardTypes[a.slice(0, 2)] || "Unknown"
            }, c.cardBrand = function (a) {
                return c.cardType(a)
            }, c.cardTypes = function () {
                var a, b, c, d;
                for (b = {}, a = c = 40; c <= 49; a = ++c) b[a] = "Visa";
                for (a = d = 50; d <= 59; a = ++d) b[a] = "MasterCard";
                return b[34] = b[37] = "American Express", b[60] = b[62] = b[64] = b[65] = "Discover", b[35] = "JCB", b[30] = b[36] = b[38] = b[39] = "Diners Club", b
            }(), c
        }(this.Stripe.token), this.Stripe.bankAccount = function (b) {
            function c() {
                return c.__super__.constructor.apply(this, arguments)
            }
            return t(c, b), c.tokenName = "bank_account", c.whitelistedAttrs = ["country", "currency", "routing_number", "account_number", "name", "account_holder_type", "account_holder_name"], c.createToken = function (b, d, e) {
                return null == d && (d = {}), a.token.validate(b, "bank account"), "function" == typeof d && (e = d, d = {}), d[c.tokenName] = a.token.formatData(b, c.whitelistedAttrs), a.token.create(d, e)
            }, c.getToken = function (b, c) {
                return a.token.get(b, c)
            }, c.validateRoutingNumber = function (b, d) {
                switch (b = a.utils.trim(b), d) {
                    case "US":
                        return /^\d+$/.test(b) && 9 === b.length && c.routingChecksum(b);
                    case "CA":
                        return /\d{5}\-\d{3}/.test(b) && 9 === b.length;
                    default:
                        return !0
                }
            }, c.validateAccountNumber = function (b, c) {
                switch (b = a.utils.trim(b), c) {
                    case "US":
                        return /^\d+$/.test(b) && b.length >= 1 && b.length <= 17;
                    default:
                        return !0
                }
            }, c.routingChecksum = function (a) {
                var b, c, d, e, f, g;
                for (d = 0, b = (a + "").split(""), g = [0, 3, 6], e = 0, f = g.length; e < f; e++) c = g[e], d += 3 * parseInt(b[c]), d += 7 * parseInt(b[c + 1]), d += parseInt(b[c + 2]);
                return 0 !== d && d % 10 === 0
            }, c
        }(this.Stripe.token), this.Stripe.piiData = function (b) {
            function c() {
                return c.__super__.constructor.apply(this, arguments)
            }
            return t(c, b), c.tokenName = "pii", c.whitelistedAttrs = ["personal_id_number"], c.createToken = function (b, d, e) {
                return null == d && (d = {}), a.token.validate(b, "pii data"), "function" == typeof d && (e = d, d = {}), d[c.tokenName] = a.token.formatData(b, c.whitelistedAttrs), a.token.create(d, e)
            }, c.getToken = function (b, c) {
                return a.token.get(b, c)
            }, c
        }(this.Stripe.token), this.Stripe._poller = function () {
            function a() {}
            return a._activePolls = {}, a._clearPoll = function (b) {
                return delete a._activePolls[b]
            }, a._defaultPollInterval = 1500, a._maxPollInterval = 24e3, a._initPoll = function (b) {
                if (null != a._activePolls[b]) throw new Error("You are already polling " + b + ". Please cancel that poll before polling it again.");
                return a._activePolls[b] = {}
            }, a._poll = function (b, c, d, e, f) {
                c(b, function (g, h) {
                    var i;
                    if (null != a._activePolls[b]) return g >= 400 && g < 500 ? (a._clearPoll(b), "function" == typeof f ? f(g, h) : void 0) : 200 === g && e(b, h) ? (a._clearPoll(b), "function" == typeof f ? f(g, h) : void 0) : (200 === g && d(b, h) && "function" == typeof f && f(g, h), 500 === g && 2 * a._activePolls[b].interval <= a._maxPollInterval ? a._activePolls[b].interval *= 2 : g >= 200 && g < 500 && (a._activePolls[b].interval = a._defaultPollInterval), i = setTimeout(function () {
                        return a._poll(b, c, d, e, f)
                    }, a._activePolls[b].interval), a._activePolls[b].timeoutId = i)
                })
            }, a._cancelPoll = function (b) {
                var c;
                if (c = a._activePolls[b], null == c) throw new Error("You are not polling " + b + ".");
                null != c.timeoutId && clearTimeout(c.timeoutId), a._clearPoll(b)
            }, a
        }(), this.Stripe.bitcoinReceiver = function (b) {
            function c() {
                return c.__super__.constructor.apply(this, arguments)
            }
            return t(c, b), c._whitelistedAttrs = ["amount", "currency", "email", "description"], c.createReceiver = function (b, c) {
                var d;
                return a.token.validate(b, "bitcoin_receiver data"), d = a.token.formatData(b, this._whitelistedAttrs), d.key = a.key || a.publishableKey, a.utils.validateKey(d.key), a.request({
                    url: "" + a.endpoint + "/bitcoin/receivers",
                    data: d,
                    method: "POST",
                    success: function (a, b) {
                        return "function" == typeof c ? c(b, a) : void 0
                    },
                    complete: a.complete(c, "A network error has occurred while creating a Bitcoin address. Please try again."),
                    timeout: 4e4
                })
            }, c.getReceiver = function (b, c) {
                var d;
                if (!b) throw new Error("receiver id required");
                return d = a.key || a.publishableKey, a.utils.validateKey(d), a.request({
                    url: "" + a.endpoint + "/bitcoin/receivers/" + b,
                    data: {
                        key: d
                    },
                    success: function (a, b) {
                        return "function" == typeof c ? c(b, a) : void 0
                    },
                    complete: a.complete(c, "A network error has occurred loading data from Stripe. Please try again."),
                    timeout: 4e4
                })
            }, c.pollReceiver = function (a, b) {
                return this._initPoll(a), this._poll(a, function (a) {
                    return function (b, c) {
                        return a.getReceiver(b, c)
                    }
                }(this), function (a, b) {
                    return !1
                }, function (a, b) {
                    return b.filled
                }, b)
            }, c.cancelReceiverPoll = function (a) {
                return c._cancelPoll(a)
            }, c
        }(this.Stripe._poller), this.Stripe.source = function (b) {
            function c() {
                return c.__super__.constructor.apply(this, arguments)
            }
            return t(c, b), c.stripeAccount = null, c.create = function (b, c) {
                var d, e;
                return a.token.validate(b, "source data"), d = a.token.formatData(b, this._whitelistedAttrs), d.key = a.key || a.publishableKey, a.utils.validateKey(d.key), d = a.utils.addAdditionalParams(d), e = {
                    url: "" + a.endpoint + "/sources",
                    data: d,
                    method: "POST",
                    success: function (a, b) {
                        return "function" == typeof c ? c(b, a) : void 0
                    },
                    complete: a.complete(c, "A network error has occurred while creating a Source. Please try again."),
                    timeout: 4e4,
                    headers: a.source.stripeAccount ? {
                        "Stripe-Account": a.source.stripeAccount
                    } : {}
                }, a._language && (e.headers["Accept-Language"] = a._language), a.request(e)
            }, c.createThreeDSecure = function (a, b) {
                var c, d, e, f;
                return c = {
                    type: "card",
                    currency: a.currency
                }, (null != (e = a.three_d_secure) ? e.card : void 0) && (c.card = {
                    number: a.three_d_secure.card.number,
                    cvc: a.three_d_secure.card.cvc,
                    exp_month: a.three_d_secure.card.exp_month,
                    exp_year: a.three_d_secure.card.exp_year
                }), (null != (f = a.owner) ? f.address : void 0) && (c.owner || (c.owner = {}), (d = c.owner).address || (d.address = a.owner.address)), this.create(c, function (c) {
                    return function (d, e) {
                        var f;
                        return 200 === d ? (f = {
                            type: "three_d_secure",
                            amount: a.amount,
                            currency: e.currency,
                            three_d_secure: {
                                card: e.id
                            },
                            redirect: {
                                return_url: a.redirect.return_url
                            }
                        }, c.create(f, b)) : [d, e]
                    }
                }(this))
            }, c.get = function (b, c, d) {
                var e, f;
                if (!b) throw new Error("sourceId required");
                if (!c) throw new Error("clientSecret required");
                return e = a.key || a.publishableKey, a.utils.validateKey(e), f = {}, f.key = e, f.client_secret = c, a.request({
                    url: "" + a.endpoint + "/sources/" + b,
                    data: f,
                    success: function (a, b) {
                        return "function" == typeof d ? d(b, a) : void 0
                    },
                    complete: a.complete(d, "A network error has occurred loading data from Stripe. Please try again."),
                    timeout: 4e4,
                    headers: a.source.stripeAccount ? {
                        "Stripe-Account": a.source.stripeAccount
                    } : {}
                })
            }, c.poll = function (a, b, c) {
                return this._initPoll(a), this._poll(a, function (a) {
                    return function (c, d) {
                        return a.get(c, b, d)
                    }
                }(this), function (a) {
                    return function (b, c) {
                        return a._activePolls[b].source_status !== c.status && (a._activePolls[b].source_status = c.status, !0)
                    }
                }(this), function (a, b) {
                    return !1
                }, c)
            }, c.cancelPoll = function (a) {
                return this._cancelPoll(a)
            }, c
        }(this.Stripe._poller), this.Stripe.threeDSecure = function () {
            function b() {}
            return b.create = function (b, c) {
                var d;
                if ("object" != typeof b) throw new Error("params must be an object.");
                if ("function" != typeof c) throw new Error("callback must be a function.");
                return b.key || (b.key = a.key || a.publishableKey), b.return_url || (b.return_url = "_callback"), a.utils.validateKey(b.key), d = {
                    url: "" + a.endpoint + "/3d_secure",
                    data: b,
                    method: "POST",
                    headers: {},
                    success: function (a, b) {
                        return "function" == typeof c ? c(b, a) : void 0
                    },
                    complete: a.complete(c, "A network error has occurred, and you have not been charged. Please try again."),
                    timeout: 4e4,
                    tokenType: "three_d_secure"
                }, a._language && (d.headers["Accept-Language"] = a._language), a.request(d), null
            }, b.createIframe = function (b, c, d) {
                var e, f;
                if (f = null, !a.validator.isUrl(b)) throw new Error("redirectUrl must be a valid URL.");
                if (!a.validator.isElementOrId(c)) throw new Error("parentElement must be a DOM Element, or the ID of a DOM element.");
                if ("function" != typeof d) throw new Error("callback must be a function.");
                return e = function (b, c) {
                    var e, g;
                    try {
                        g = a.JSON.parse(b)
                    } catch (h) {
                        throw e = h, a.reportError("InvalidJSON-3DSecureCallback"), new Error("Stripe.js received invalid JSON")
                    }
                    return f.destroy(), d(g)
                }, f = new a.easyXDM.Socket({
                    swf: "" + a._iframeBaseUrl + "/v2/stripexdm.swf",
                    remote: b,
                    onMessage: e,
                    container: c
                }), null
            }, b
        }(), this.Stripe.applePay = function () {
            function b() {}
            return b.stripeAccount = null, b._isOverHTTPS = function () {
                return "https:" === window.location.protocol
            }, b.checkAvailability = function (b) {
                var c, d, e, f;
                if (null == b) throw new Error("This function executes asynchronously; please pass it a callback function.");
                return this._isOverHTTPS() ? (d = /^pk_test_/.test(a.key || a.publishableKey)) ? void b(null != (e = window.ApplePaySession) ? e.canMakePayments() : void 0) : (null != (f = window.ApplePaySession) ? f.canMakePayments() : void 0) ? (c = this.stripeAccount ? "merchant." + window.location.hostname + "." + this.stripeAccount + ".stripe" : "merchant." + window.location.hostname + ".stripe", ApplePaySession.canMakePaymentsWithActiveCard(c).then(function (a) {
                    return b(a)
                })) : void b(!1) : (console.warn("To use Apple Pay, you must serve your page over HTTPS."), void b(!1))
            }, b.buildSession = function (b, c, d) {
                return new a.ApplePaySession(b, c, d)
            }, b.createToken = function (b, c) {
                var d, e, f;
                return d = {
                    apple_pay: !0,
                    pk_token: a.JSON.stringify(b.token.paymentData),
                    pk_token_transaction_id: b.token.transactionIdentifier,
                    pk_token_payment_network: b.token.paymentMethod.network,
                    pk_token_instrument_name: b.token.paymentMethod.displayName
                }, null != b.billingContact && (d.card = {
                    name: [b.billingContact.givenName, b.billingContact.familyName].join(" ").trim(),
                    address_line1: null != (e = b.billingContact.addressLines) ? e[0] : void 0,
                    address_line2: null != (f = b.billingContact.addressLines) ? f[1] : void 0,
                    address_city: b.billingContact.locality,
                    address_state: b.billingContact.administrativeArea,
                    address_zip: b.billingContact.postalCode,
                    address_country: b.billingContact.countryCode
                }), a.token.create(d, c)
            }, b
        }(), e = ["createToken", "getToken", "cardType", "validateExpiry", "validateCVC", "validateCardNumber"], q = 0, r = e.length; q < r; q++) k = e[q], this.Stripe[k] = this.Stripe.card[k];
    if (this.Stripe.stripejs_ua = "stripe.js/7315d41", !this.Stripe._isChannel && true) try {
        c = [], "function" == typeof window.addEventListener && window.addEventListener("message", function (b) {
            var d, e, f, g, h, i;
            if (null == a.StripeV3 && !a.isDoubleLoaded) {
                try {
                    d = a.JSON.parse(b.data)
                } catch (j) {
                    return void(f = j)
                }
                if ("m2" === (null != d ? d.originatingScript : void 0) && /stripe\.com$/.test(b.origin)) {
                    for (a.__mids = {
                            guid: d.payload.guid,
                            sid: d.payload.sid,
                            muid: d.payload.muid
                        }, h = a.utils.getSessionID(), g = a.utils.getMerchantID(), i = []; c.length;) e = c.shift(), i.push(e(h, g));
                    return i
                }
            }
        }, !1), l = !1, b = function () {
            var b, d, e, f, g, h, i, k, m, n, o, p, q, r, s, t, u, v;
            try {
                if (null != a.StripeV3 || a.isDoubleLoaded || l) return;
                l = !0, t = document.location.href, m = null;
                try {
                    if (k = document.querySelector("meta[name=referrer]"), null != k) switch (m = null != (v = k.content) ? v.toLowerCase() : void 0) {
                        case "origin":
                        case "strict-origin":
                        case "origin-when-cross-origin":
                        case "strict-origin-when-cross-origin":
                            t = document.location.origin;
                            break;
                        case "unsafe-url":
                            t = null != t ? t.split("#")[0] : void 0
                    }
                } catch (w) {
                    b = w
                }
                g = /checkout\.stripe\.com$/.test("undefined" != typeof window && null !== window ? window.location.host : void 0), d = {
                    referrer: document.referrer,
                    title: document.title,
                    url: t,
                    muid: a.utils.getMerchantID(),
                    sid: a.utils.getSessionID(),
                    version: 6,
                    preview: j && !g
                }, null != m && (d.metaReferrerPolicy = m), f = "#";
                for (n in d) u = d[n], f += "" + n + "=" + encodeURIComponent(u) + "&";
                i = document.createElement("iframe"), i.src = "https://js.stripe.com/v2/m/outer.html" + f, i.style.cssText = "width: 1px !important; height: 1px !important;\nposition: fixed !important; visibility: hidden !important;\npointer-events: none !important", i.setAttribute("frameborder", "0"), i.setAttribute("allowTransparency", "true"), i.setAttribute("scrolling", "no"), i.setAttribute("tabIndex", "-1"), i.setAttribute("aria-hidden", "true"), document.body.appendChild(i), r = function (a) {
                    return function (a) {
                        try {
                            return i.contentWindow.postMessage(JSON.stringify(a), "*")
                        } catch (c) {
                            b = c
                        }
                    }
                }(this), s = function (b) {
                    return function (b) {
                        var d;
                        return a.__mids ? (b.sid = a.utils.getSessionID(), b.muid = a.utils.getMerchantID(), r(b)) : (d = function (a, c) {
                            return b.sid = a, b.muid = c, r(b)
                        }, c.push(d))
                    }
                }(this), o = window.location.href, setInterval(function () {
                    var a;
                    if (a = window.location.href, a !== o) return s({
                        action: "ping",
                        referrer: o,
                        url: a,
                        title: document.title,
                        version: 6
                    }), o = a
                }, 5e3), s({
                    action: "ping",
                    referrer: o,
                    url: window.location.href,
                    title: document.title,
                    v2: 2,
                    version: 6
                })
            } catch (w) {
                b = w, a.reportError("FailedMFrameLoad")
            }
            return q = function (a, b) {
                return s({
                    action: "track",
                    url: window.location.href,
                    source: a,
                    data: b,
                    version: 6
                })
            }, h = [], p = new Date, e = function () {
                var a;
                try {
                    return a = new Date, h.push(a - p), 10 === h.length && (q("mouse-timings-10", h), q("mouse-timings-10-v2", h), document.removeEventListener("mousemove", e)), p = a
                } catch (c) {
                    b = c
                }
            }, document.addEventListener("mousemove", e)
        }, "function" == typeof window.addEventListener && window.addEventListener("load", b), setTimeout(b, 5e3)
    } catch (u) {
        d = u
    }
    try {
        "function" == typeof document.addEventListener && document.addEventListener("paste", function (b) {
            var c, d;
            try {
                if (c = {
                        "cc-csc": "cvc",
                        "cc-exp-month": "exp",
                        "cc-exp-year": "exp",
                        "cc-number": "number",
                        email: "email",
                        "postal-code": "zip",
                        zip: "zip"
                    }, d = c[b.target.autocomplete] || a.utils.typeOfString(b.clipboardData.getData("text/plain"))) return m[d] = !0
            } catch (e) {
                b = e
            }
        })
    } catch (u) {
        d = u
    }
    "undefined" != typeof module && null !== module && (module.exports = this.Stripe), "function" == typeof define && define("stripe", [], function (a) {
        return function () {
            return a.Stripe
        }
    }(this))
}).call(this),
    function () {
        this.Stripe.isDoubleLoaded || function (a) {
            function b(a, e) {
                function f(a) {
                    if (f[a] !== q) return f[a];
                    var b;
                    if ("bug-string-char-index" == a) b = "a" != "a" [0];
                    else if ("json" == a) b = f("json-stringify") && f("json-parse");
                    else {
                        var c, d = '{"a":[1,true,false,null,"\\u0000\\b\\n\\f\\r\\t"]}';
                        if ("json-stringify" == a) {
                            var i = e.stringify,
                                k = "function" == typeof i && t;
                            if (k) {
                                (c = function () {
                                    return 1
                                }).toJSON = c;
                                try {
                                    k = "0" === i(0) && "0" === i(new g) && '""' == i(new h) && i(s) === q && i(q) === q && i() === q && "1" === i(c) && "[1]" == i([c]) && "[null]" == i([q]) && "null" == i(null) && "[null,null,null]" == i([q, s, null]) && i({
                                        a: [c, !0, !1, null, "\0\b\n\f\r\t"]
                                    }) == d && "1" === i(null, c) && "[\n 1,\n 2\n]" == i([1, 2], null, 1) && '"-271821-04-20T00:00:00.000Z"' == i(new j((-864e13))) && '"+275760-09-13T00:00:00.000Z"' == i(new j(864e13)) && '"-000001-01-01T00:00:00.000Z"' == i(new j((-621987552e5))) && '"1969-12-31T23:59:59.999Z"' == i(new j((-1)))
                                } catch (l) {
                                    k = !1
                                }
                            }
                            b = k
                        }
                        if ("json-parse" == a) {
                            var m = e.parse;
                            if ("function" == typeof m) try {
                                if (0 === m("0") && !m(!1)) {
                                    c = m(d);
                                    var n = 5 == c.a.length && 1 === c.a[0];
                                    if (n) {
                                        try {
                                            n = !m('"\t"')
                                        } catch (l) {}
                                        if (n) try {
                                            n = 1 !== m("01")
                                        } catch (l) {}
                                        if (n) try {
                                            n = 1 !== m("1.")
                                        } catch (l) {}
                                    }
                                }
                            } catch (l) {
                                n = !1
                            }
                            b = n
                        }
                    }
                    return f[a] = !!b
                }
                a || (a = d.Object()), e || (e = d.Object());
                var g = a.Number || d.Number,
                    h = a.String || d.String,
                    i = a.Object || d.Object,
                    j = a.Date || d.Date,
                    k = a.SyntaxError || d.SyntaxError,
                    l = a.TypeError || d.TypeError,
                    m = a.Math || d.Math,
                    n = a.JSON || d.JSON;
                "object" == typeof n && n && (e.stringify = n.stringify, e.parse = n.parse);
                var o, p, q, r = i.prototype,
                    s = r.toString,
                    t = new j((-0xc782b5b800cec));
                try {
                    t = t.getUTCFullYear() == -109252 && 0 === t.getUTCMonth() && 1 === t.getUTCDate() && 10 == t.getUTCHours() && 37 == t.getUTCMinutes() && 6 == t.getUTCSeconds() && 708 == t.getUTCMilliseconds()
                } catch (u) {}
                if (!f("json")) {
                    var v = "[object Function]",
                        w = "[object Date]",
                        x = "[object Number]",
                        y = "[object String]",
                        z = "[object Array]",
                        A = "[object Boolean]",
                        B = f("bug-string-char-index");
                    if (!t) var C = m.floor,
                        D = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334],
                        E = function (a, b) {
                            return D[b] + 365 * (a - 1970) + C((a - 1969 + (b = +(b > 1))) / 4) - C((a - 1901 + b) / 100) + C((a - 1601 + b) / 400)
                        };
                    if ((o = r.hasOwnProperty) || (o = function (a) {
                            var b, c = {};
                            return (c.__proto__ = null, c.__proto__ = {
                                toString: 1
                            }, c).toString != s ? o = function (a) {
                                var b = this.__proto__,
                                    c = a in (this.__proto__ = null, this);
                                return this.__proto__ = b, c
                            } : (b = c.constructor, o = function (a) {
                                var c = (this.constructor || b).prototype;
                                return a in this && !(a in c && this[a] === c[a])
                            }), c = null, o.call(this, a)
                        }), p = function (a, b) {
                            var d, e, f, g = 0;
                            (d = function () {
                                this.valueOf = 0
                            }).prototype.valueOf = 0, e = new d;
                            for (f in e) o.call(e, f) && g++;
                            return d = e = null, g ? p = 2 == g ? function (a, b) {
                                var c, d = {},
                                    e = s.call(a) == v;
                                for (c in a) e && "prototype" == c || o.call(d, c) || !(d[c] = 1) || !o.call(a, c) || b(c)
                            } : function (a, b) {
                                var c, d, e = s.call(a) == v;
                                for (c in a) e && "prototype" == c || !o.call(a, c) || (d = "constructor" === c) || b(c);
                                (d || o.call(a, c = "constructor")) && b(c)
                            } : (e = ["valueOf", "toString", "toLocaleString", "propertyIsEnumerable", "isPrototypeOf", "hasOwnProperty", "constructor"], p = function (a, b) {
                                var d, f, g = s.call(a) == v,
                                    h = !g && "function" != typeof a.constructor && c[typeof a.hasOwnProperty] && a.hasOwnProperty || o;
                                for (d in a) g && "prototype" == d || !h.call(a, d) || b(d);
                                for (f = e.length; d = e[--f]; h.call(a, d) && b(d));
                            }), p(a, b)
                        }, !f("json-stringify")) {
                        var F = {
                                92: "\\\\",
                                34: '\\"',
                                8: "\\b",
                                12: "\\f",
                                10: "\\n",
                                13: "\\r",
                                9: "\\t"
                            },
                            G = "000000",
                            H = function (a, b) {
                                return (G + (b || 0)).slice(-a)
                            },
                            I = "\\u00",
                            J = function (a) {
                                for (var b = '"', c = 0, d = a.length, e = !B || d > 10, f = e && (B ? a.split("") : a); c < d; c++) {
                                    var g = a.charCodeAt(c);
                                    switch (g) {
                                        case 8:
                                        case 9:
                                        case 10:
                                        case 12:
                                        case 13:
                                        case 34:
                                        case 92:
                                            b += F[g];
                                            break;
                                        default:
                                            if (g < 32) {
                                                b += I + H(2, g.toString(16));
                                                break
                                            }
                                            b += e ? f[c] : a.charAt(c)
                                    }
                                }
                                return b + '"'
                            },
                            K = function (a, b, c, d, e, f, g) {
                                var h, i, j, k, m, n, r, t, u, v, B, D, F, G, I, L;
                                try {
                                    h = b[a]
                                } catch (M) {}
                                if ("object" == typeof h && h)
                                    if (i = s.call(h), i != w || o.call(h, "toJSON")) "function" == typeof h.toJSON && (i != x && i != y && i != z || o.call(h, "toJSON")) && (h = h.toJSON(a));
                                    else if (h > -1 / 0 && h < 1 / 0) {
                                    if (E) {
                                        for (m = C(h / 864e5), j = C(m / 365.2425) + 1970 - 1; E(j + 1, 0) <= m; j++);
                                        for (k = C((m - E(j, 0)) / 30.42); E(j, k + 1) <= m; k++);
                                        m = 1 + m - E(j, k), n = (h % 864e5 + 864e5) % 864e5, r = C(n / 36e5) % 24, t = C(n / 6e4) % 60, u = C(n / 1e3) % 60, v = n % 1e3
                                    } else j = h.getUTCFullYear(), k = h.getUTCMonth(), m = h.getUTCDate(), r = h.getUTCHours(), t = h.getUTCMinutes(), u = h.getUTCSeconds(), v = h.getUTCMilliseconds();
                                    h = (j <= 0 || j >= 1e4 ? (j < 0 ? "-" : "+") + H(6, j < 0 ? -j : j) : H(4, j)) + "-" + H(2, k + 1) + "-" + H(2, m) + "T" + H(2, r) + ":" + H(2, t) + ":" + H(2, u) + "." + H(3, v) + "Z"
                                } else h = null;
                                if (c && (h = c.call(b, a, h)), null === h) return "null";
                                if (i = s.call(h), i == A) return "" + h;
                                if (i == x) return h > -1 / 0 && h < 1 / 0 ? "" + h : "null";
                                if (i == y) return J("" + h);
                                if ("object" == typeof h) {
                                    for (G = g.length; G--;)
                                        if (g[G] === h) throw l();
                                    if (g.push(h), B = [], I = f, f += e, i == z) {
                                        for (F = 0, G = h.length; F < G; F++) D = K(F, h, c, d, e, f, g), B.push(D === q ? "null" : D);
                                        L = B.length ? e ? "[\n" + f + B.join(",\n" + f) + "\n" + I + "]" : "[" + B.join(",") + "]" : "[]"
                                    } else p(d || h, function (a) {
                                        var b = K(a, h, c, d, e, f, g);
                                        b !== q && B.push(J(a) + ":" + (e ? " " : "") + b)
                                    }), L = B.length ? e ? "{\n" + f + B.join(",\n" + f) + "\n" + I + "}" : "{" + B.join(",") + "}" : "{}";
                                    return g.pop(), L
                                }
                            };
                        e.stringify = function (a, b, d) {
                            var e, f, g, h;
                            if (c[typeof b] && b)
                                if ((h = s.call(b)) == v) f = b;
                                else if (h == z) {
                                g = {};
                                for (var i, j = 0, k = b.length; j < k; i = b[j++], h = s.call(i), (h == y || h == x) && (g[i] = 1));
                            }
                            if (d)
                                if ((h = s.call(d)) == x) {
                                    if ((d -= d % 1) > 0)
                                        for (e = "", d > 10 && (d = 10); e.length < d; e += " ");
                                } else h == y && (e = d.length <= 10 ? d : d.slice(0, 10));
                            return K("", (i = {}, i[""] = a, i), f, g, e, "", [])
                        }
                    }
                    if (!f("json-parse")) {
                        var L, M, N = h.fromCharCode,
                            O = {
                                92: "\\",
                                34: '"',
                                47: "/",
                                98: "\b",
                                116: "\t",
                                110: "\n",
                                102: "\f",
                                114: "\r"
                            },
                            P = function () {
                                throw L = M = null, k()
                            },
                            Q = function () {
                                for (var a, b, c, d, e, f = M, g = f.length; L < g;) switch (e = f.charCodeAt(L)) {
                                    case 9:
                                    case 10:
                                    case 13:
                                    case 32:
                                        L++;
                                        break;
                                    case 123:
                                    case 125:
                                    case 91:
                                    case 93:
                                    case 58:
                                    case 44:
                                        return a = B ? f.charAt(L) : f[L], L++, a;
                                    case 34:
                                        for (a = "@", L++; L < g;)
                                            if (e = f.charCodeAt(L), e < 32) P();
                                            else if (92 == e) switch (e = f.charCodeAt(++L)) {
                                            case 92:
                                            case 34:
                                            case 47:
                                            case 98:
                                            case 116:
                                            case 110:
                                            case 102:
                                            case 114:
                                                a += O[e], L++;
                                                break;
                                            case 117:
                                                for (b = ++L, c = L + 4; L < c; L++) e = f.charCodeAt(L), e >= 48 && e <= 57 || e >= 97 && e <= 102 || e >= 65 && e <= 70 || P();
                                                a += N("0x" + f.slice(b, L));
                                                break;
                                            default:
                                                P()
                                        } else {
                                            if (34 == e) break;
                                            for (e = f.charCodeAt(L), b = L; e >= 32 && 92 != e && 34 != e;) e = f.charCodeAt(++L);
                                            a += f.slice(b, L)
                                        }
                                        if (34 == f.charCodeAt(L)) return L++, a;
                                        P();
                                    default:
                                        if (b = L, 45 == e && (d = !0, e = f.charCodeAt(++L)), e >= 48 && e <= 57) {
                                            for (48 == e && (e = f.charCodeAt(L + 1), e >= 48 && e <= 57) && P(), d = !1; L < g && (e = f.charCodeAt(L), e >= 48 && e <= 57); L++);
                                            if (46 == f.charCodeAt(L)) {
                                                for (c = ++L; c < g && (e = f.charCodeAt(c), e >= 48 && e <= 57); c++);
                                                c == L && P(), L = c
                                            }
                                            if (e = f.charCodeAt(L), 101 == e || 69 == e) {
                                                for (e = f.charCodeAt(++L), 43 != e && 45 != e || L++, c = L; c < g && (e = f.charCodeAt(c), e >= 48 && e <= 57); c++);
                                                c == L && P(), L = c
                                            }
                                            return +f.slice(b, L)
                                        }
                                        if (d && P(), "true" == f.slice(L, L + 4)) return L += 4, !0;
                                        if ("false" == f.slice(L, L + 5)) return L += 5, !1;
                                        if ("null" == f.slice(L, L + 4)) return L += 4, null;
                                        P()
                                }
                                return "$"
                            },
                            R = function (a) {
                                var b, c;
                                if ("$" == a && P(), "string" == typeof a) {
                                    if ("@" == (B ? a.charAt(0) : a[0])) return a.slice(1);
                                    if ("[" == a) {
                                        for (b = []; a = Q(), "]" != a; c || (c = !0)) c && ("," == a ? (a = Q(), "]" == a && P()) : P()), "," == a && P(), b.push(R(a));
                                        return b
                                    }
                                    if ("{" == a) {
                                        for (b = {}; a = Q(), "}" != a; c || (c = !0)) c && ("," == a ? (a = Q(), "}" == a && P()) : P()), "," != a && "string" == typeof a && "@" == (B ? a.charAt(0) : a[0]) && ":" == Q() || P(), b[a.slice(1)] = R(Q());
                                        return b
                                    }
                                    P()
                                }
                                return a
                            },
                            S = function (a, b, c) {
                                var d = T(a, b, c);
                                d === q ? delete a[b] : a[b] = d
                            },
                            T = function (a, b, c) {
                                var d, e = a[b];
                                if ("object" == typeof e && e)
                                    if (s.call(e) == z)
                                        for (d = e.length; d--;) S(e, d, c);
                                    else p(e, function (a) {
                                        S(e, a, c)
                                    });
                                return c.call(a, b, e)
                            };
                        e.parse = function (a, b) {
                            var c, d;
                            return L = 0, M = "" + a, c = R(Q()), "$" != Q() && P(), L = M = null, b && s.call(b) == v ? T((d = {}, d[""] = c, d), "", b) : c
                        }
                    }
                }
                return e.runInContext = b, e
            }
            var c = {
                    "function": !0,
                    object: !0
                },
                d = this,
                e = b(a, d);
            d.JSON = {
                parse: e.parse,
                stringify: e.stringify
            }
        }.call(Stripe, this)
    }.call(this),
    function () {
        this.Stripe.isDoubleLoaded || ! function (a, b, c, d, e, f) {
            function g(a, b) {
                var c = typeof a[b];
                return "function" == c || !("object" != c || !a[b]) || "unknown" == c
            }

            function h() {
                var a = "Shockwave Flash",
                    b = "application/x-shockwave-flash";
                if (!p(navigator.plugins) && "object" == typeof navigator.plugins[a]) {
                    var c = navigator.plugins[a].description;
                    c && !p(navigator.mimeTypes) && navigator.mimeTypes[b] && navigator.mimeTypes[b].enabledPlugin && (x = c.match(/\d+/g))
                }
                if (!x) {
                    var d;
                    try {
                        d = new ActiveXObject("ShockwaveFlash.ShockwaveFlash"), x = Array.prototype.slice.call(d.GetVariable("$version").match(/(\d+),(\d+),(\d+),(\d+)/), 1), d = null
                    } catch (e) {}
                }
                if (!x) return !1;
                var f = parseInt(x[0], 10),
                    g = parseInt(x[1], 10);
                return y = f > 9 && g > 0, !0
            }

            function i() {
                if (!L) {
                    L = !0;
                    for (var a = 0; a < M.length; a++) M[a]();
                    M.length = 0
                }
            }

            function j(a, b) {
                return L ? void a.call(b) : void M.push(function () {
                    a.call(b)
                })
            }

            function k(a) {
                return a.match(D)[3]
            }

            function l(a) {
                return a.match(D)[4] || ""
            }

            function m(a) {
                var b, c, d = a.toLowerCase().match(D),
                    e = "",
                    f = "";
                try {
                    b = d[2], c = d[3], e = d[4] || "", ("http:" == b && ":80" == e || "https:" == b && ":443" == e) && (e = ""), f = b + "//" + c + e
                } catch (g) {
                    f = a
                }
                return f
            }

            function n(a) {
                if (a = a.replace(F, "$1/"), !a.match(/^(http||https):\/\//)) {
                    var b = "/" === a.substring(0, 1) ? "" : c.pathname;
                    "/" !== b.substring(b.length - 1) && (b = b.substring(0, b.lastIndexOf("/") + 1)), a = c.protocol + "//" + c.host + b + a
                }
                for (; E.test(a);) a = a.replace(E, "");
                return a
            }

            function o(a, b) {
                var c = "",
                    d = a.indexOf("#");
                d !== -1 && (c = a.substring(d), a = a.substring(0, d));
                var e, g = [];
                for (var h in b) b.hasOwnProperty(h) && (e = "stripe_" + h, g.push(e + "=" + f(b[h])));
                return a + (J ? "#" : a.indexOf("?") == -1 ? "?" : "&") + g.join("&") + c
            }

            function p(a) {
                return "undefined" == typeof a
            }

            function q(a, b, c) {
                var d;
                for (var e in b) b.hasOwnProperty(e) && (e in a ? (d = b[e], "object" == typeof d ? q(a[e], d, c) : c || (a[e] = b[e])) : a[e] = b[e]);
                return a
            }

            function r() {
                var a = b.body.appendChild(b.createElement("form")),
                    c = a.appendChild(b.createElement("input"));
                c.name = I + "TEST" + C, w = c !== a.elements[c.name], b.body.removeChild(a)
            }

            function s(c) {
                p(w) && r();
                var e;
                w ? e = b.createElement('<iframe name="' + c.props.name + '"/>') : (e = b.createElement("IFRAME"), e.name = c.props.name), e.id = e.name = c.props.name, e.setAttribute("aria-hidden", "true"), delete c.props.name, "string" == typeof c.container && (c.container = b.getElementById(c.container)), c.container || (q(e.style, {
                    position: "absolute",
                    top: "-2000px",
                    left: "0px"
                }), c.container = b.body);
                var f = c.props.src;
                c.props.src = "about:blank", q(e, c.props), e.border = e.frameBorder = 0, e.allowTransparency = !0;
                var g = !1;
                return c.onFrameAck && "postMessage" in a && a.addEventListener ? a.addEventListener("message", function (a) {
                    var b = Stripe._iframeBaseUrl.replace(/^https?:\/\//, "").replace(/\/.*$/, ""),
                        d = a.origin.replace(/^https?:\/\//, "").replace(/\/.*$/, "");
                    b === d && "stripe:ack" === a.data && c.onFrameAck(!0)
                }, !1) : g = !0, c.container.appendChild(e), c.onLoad && z(e, "load", function () {
                    c.onLoad.apply(c, arguments), g && c.onFrameAck(!1)
                }), c.onError && z(e, "error", function () {
                    c.onError.apply(c, arguments)
                }), e.src = f, c.onAsyncInject && d(function () {
                    c.onAsyncInject.call(c, e)
                }, 5e3), c.props.src = f, e
            }

            function t(c) {
                var d, e = c.protocol;
                if (c.isHost = c.isHost || p(O.xdm_p), J = c.hash || !1, c.props || (c.props = {}), c.isHost) {
                    if (c.remote = n(c.remote), c.channel = c.channel || "default" + C++, c.secret = Math.random().toString(16).substring(2), p(e))
                        if (g(a, "postMessage") || g(b, "postMessage")) e = "1";
                        else {
                            if (!(c.swf && g(a, "ActiveXObject") && h())) throw new Error("No suitable transport protocol for Stripe.js");
                            e = "6"
                        }
                } else c.channel = O.xdm_c.replace(/["'<>\\]/g, ""), c.secret = O.xdm_s, c.remote = O.xdm_e.replace(/["'<>\\]/g, ""), e = O.xdm_p;
                switch (c.protocol = e, e) {
                    case "1":
                        d = [new H.stack.PostMessageTransport(c)];
                        break;
                    case "6":
                        x || h(), d = [new H.stack.FlashTransport(c)]
                }
                return d ? (d.push(new H.stack.QueueBehavior({
                    lazy: c.lazy,
                    remove: !0
                })), d) : void c.onInternalError.call(c, "BadXDMProtocol")
            }

            function u(a) {
                for (var b, c = {
                        incoming: function (a, b) {
                            this.up.incoming(a, b)
                        },
                        outgoing: function (a, b) {
                            this.down.outgoing(a, b)
                        },
                        callback: function (a) {
                            this.up.callback(a)
                        },
                        init: function () {
                            this.down.init()
                        },
                        destroy: function () {
                            this.down.destroy()
                        }
                    }, d = 0, e = a.length; d < e; d++) b = a[d], q(b, c, !0), 0 !== d && (b.down = a[d - 1]), d !== e - 1 && (b.up = a[d + 1]);
                return b
            }

            function v(a) {
                a.up.down = a.down, a.down.up = a.up, a.up = a.down = null
            }
            var w, x, y, z, A, B = this,
                C = Math.floor(1e6 * Math.random()),
                D = (Function.prototype, /^((http:|https:|file:|chrome\-extension:|chrome:)\/\/([^:\/\s]+)(:\d+)*)/),
                E = /[\-\w]+\/\.\.\//,
                F = /([^:])\/\//g,
                G = "Stripe",
                H = {},
                I = "stripeXDM_",
                J = !1;
            if (g(a, "addEventListener")) z = function (a, b, c) {
                a.addEventListener(b, c, !1)
            }, A = function (a, b, c) {
                a.removeEventListener(b, c, !1)
            };
            else {
                if (!g(a, "attachEvent")) throw new Error("Browser not supported");
                z = function (a, b, c) {
                    a.attachEvent("on" + b, c)
                }, A = function (a, b, c) {
                    a.detachEvent("on" + b, c)
                }
            }
            var K, L = !1,
                M = [];
            if ("readyState" in b ? (K = b.readyState, L = "complete" == K || ~navigator.userAgent.indexOf("AppleWebKit/") && ("loaded" == K || "interactive" == K)) : L = !!b.body, !L) {
                if (g(a, "addEventListener")) z(b, "DOMContentLoaded", i);
                else if (z(b, "readystatechange", function () {
                        "complete" == b.readyState && i()
                    }), b.documentElement.doScroll && a === top) {
                    var N = function () {
                        if (!L) {
                            try {
                                b.documentElement.doScroll("left")
                            } catch (a) {
                                return void d(N, 1)
                            }
                            i()
                        }
                    };
                    N()
                }
                z(a, "load", i)
            }
            var O = function (a) {
                    a = a.substring(1).split("&");
                    for (var b, c = {}, d = a.length; d--;) b = a[d].split("="), c[b[0].replace(/^stripe_/, "")] = e(b[1]);
                    return c
                }(/stripe_xdm_e=/.test(c.search) ? c.search : c.hash),
                P = function () {
                    return Stripe.JSON
                };
            q(H, {
                    version: "2.4.19.3",
                    query: O,
                    stack: {},
                    apply: q,
                    getJSONObject: P,
                    whenReady: j
                }), H.DomHelper = {
                    on: z,
                    un: A
                },
                function () {
                    var a = {};
                    H.Fn = {
                        set: function (b, c) {
                            a[b] = c
                        },
                        get: function (b, c) {
                            if (a.hasOwnProperty(b)) {
                                var d = a[b];
                                return c && delete a[b], d
                            }
                        }
                    }
                }(), H.Socket = function (a) {
                    var b = u(t(a).concat([{
                            incoming: function (b, c) {
                                a.onMessage(b, c)
                            },
                            callback: function (b) {
                                a.onReady && a.onReady(b)
                            }
                        }])),
                        c = m(a.remote);
                    this.origin = m(a.remote), this.destroy = function () {
                        b.destroy()
                    }, this.postMessage = function (a) {
                        b.outgoing(a, c)
                    }, b.init()
                }, H.stack.FlashTransport = function (a) {
                    function e(a, b) {
                        d(function () {
                            h.up.incoming(a, p)
                        }, 0)
                    }

                    function g(c) {
                        var d = a.swf + "?host=" + a.isHost,
                            e = "easyXDM_swf_" + Math.floor(1e4 * Math.random());
                        H.Fn.set("flash_loaded" + c.replace(/[\-.]/g, "_"), function () {
                            H.stack.FlashTransport[c].swf = r = t.firstChild;
                            for (var a = H.stack.FlashTransport[c].queue, b = 0; b < a.length; b++) a[b]();
                            a.length = 0
                        }), a.swfContainer ? t = "string" == typeof a.swfContainer ? b.getElementById(a.swfContainer) : a.swfContainer : (t = b.createElement("div"), q(t.style, y && a.swfNoThrottle ? {
                            height: "20px",
                            width: "20px",
                            position: "fixed",
                            right: 0,
                            top: 0
                        } : {
                            height: "1px",
                            width: "1px",
                            position: "absolute",
                            overflow: "hidden",
                            right: 0,
                            top: 0
                        }), b.body.appendChild(t));
                        var g = "callback=flash_loaded" + f(c.replace(/[\-.]/g, "_")) + "&proto=" + B.location.protocol + "&domain=" + f(k(B.location.href)) + "&port=" + f(l(B.location.href)) + "&ns=" + f(G);
                        t.innerHTML = "<object height='20' width='20' type='application/x-shockwave-flash' id='" + e + "' data='" + d + "'><param name='allowScriptAccess' value='always'></param><param name='wmode' value='transparent'><param name='movie' value='" + d + "'></param><param name='flashvars' value='" + g + "'></param><embed type='application/x-shockwave-flash' FlashVars='" + g + "' allowScriptAccess='always' wmode='transparent' src='" + d + "' height='1' width='1'></embed></object>"
                    }
                    var h, i, p, r, t;
                    return h = {
                        outgoing: function (b, c, d) {
                            r.postMessage(a.channel, b.toString()), d && d()
                        },
                        destroy: function () {
                            try {
                                r.destroyChannel(a.channel)
                            } catch (b) {}
                            r = null, i && (i.parentNode.removeChild(i), i = null)
                        },
                        onDOMReady: function () {
                            p = a.remote, H.Fn.set("flash_" + a.channel + "_init", function () {
                                d(function () {
                                    h.up.callback(!0)
                                })
                            }), H.Fn.set("flash_" + a.channel + "_onMessage", e), a.swf = n(a.swf);
                            var b = k(a.swf),
                                f = function () {
                                    H.stack.FlashTransport[b].init = !0, r = H.stack.FlashTransport[b].swf, r.createChannel(a.channel, a.secret, m(a.remote), a.isHost), a.isHost && (y && a.swfNoThrottle && q(a.props, {
                                        position: "fixed",
                                        right: 0,
                                        top: 0,
                                        height: "20px",
                                        width: "20px"
                                    }), q(a.props, {
                                        src: o(a.remote, {
                                            xdm_e: m(c.href),
                                            xdm_c: a.channel,
                                            xdm_p: 6,
                                            xdm_s: a.secret
                                        }),
                                        name: I + a.channel + "_provider"
                                    }), i = s(a))
                                };
                            H.stack.FlashTransport[b] && H.stack.FlashTransport[b].init ? f() : H.stack.FlashTransport[b] ? H.stack.FlashTransport[b].queue.push(f) : (H.stack.FlashTransport[b] = {
                                queue: [f]
                            }, g(b))
                        },
                        init: function () {
                            j(h.onDOMReady, h)
                        }
                    }
                }, H.stack.PostMessageTransport = function (b) {
                    function e(a) {
                        if (a.origin) return m(a.origin);
                        if (a.uri) return m(a.uri);
                        if (a.domain) return c.protocol + "//" + a.domain;
                        throw new Error("Unable to retrieve the origin of the event")
                    }

                    function f(a) {
                        var c = e(a);
                        c == k && "string" == typeof a.data && a.data.substring(0, b.channel.length + 1) == b.channel + " " && g.up.incoming(a.data.substring(b.channel.length + 1), c)
                    }
                    var g, h, i, k;
                    return g = {
                        outgoing: function (a, c, d) {
                            try {
                                i.postMessage(b.channel + " " + a, c || k), d && d()
                            } catch (e) {
                                b.onInternalError && b.onInternalError.call(b, "CallerWindowError")
                            }
                        },
                        destroy: function () {
                            A(a, "message", f), h && (i = null, h.parentNode.removeChild(h), h = null)
                        },
                        onDOMReady: function () {
                            if (k = m(b.remote), b.isHost) {
                                var e = function (c) {
                                    c.data == b.channel + "-ready" && (i = "postMessage" in h.contentWindow ? h.contentWindow : h.contentWindow.document, A(a, "message", e), z(a, "message", f), d(function () {
                                        g.up.callback(!0)
                                    }, 0))
                                };
                                z(a, "message", e), q(b.props, {
                                    src: o(b.remote, {
                                        xdm_e: m(c.href),
                                        xdm_c: b.channel,
                                        xdm_p: 1
                                    }),
                                    name: I + b.channel + "_provider"
                                }), h = s(b)
                            } else z(a, "message", f), i = "postMessage" in a.parent ? a.parent : a.parent.document, i.postMessage(b.channel + "-ready", k), d(function () {
                                g.up.callback(!0)
                            }, 0)
                        },
                        init: function () {
                            j(g.onDOMReady, g)
                        }
                    }
                }, H.stack.QueueBehavior = function (a) {
                    function b() {
                        if (a.remove && 0 === h.length) return void v(c);
                        if (!i && 0 !== h.length && !g) {
                            i = !0;
                            var e = h.shift();
                            c.down.outgoing(e.data, e.origin, function (a) {
                                i = !1, e.callback && d(function () {
                                    e.callback(a)
                                }, 0), b()
                            })
                        }
                    }
                    var c, g, h = [],
                        i = !0,
                        j = "",
                        k = 0,
                        l = !1,
                        m = !1;
                    return c = {
                        init: function () {
                            p(a) && (a = {}), a.maxLength && (k = a.maxLength, m = !0), a.lazy ? l = !0 : c.down.init()
                        },
                        callback: function (a) {
                            i = !1;
                            var d = c.up;
                            b(), d.callback(a)
                        },
                        incoming: function (b, d) {
                            if (m) {
                                var f = b.indexOf("_"),
                                    g = parseInt(b.substring(0, f), 10);
                                j += b.substring(f + 1), 0 === g && (a.encode && (j = e(j)), c.up.incoming(j, d), j = "")
                            } else c.up.incoming(b, d)
                        },
                        outgoing: function (d, e, g) {
                            a.encode && (d = f(d));
                            var i, j = [];
                            if (m) {
                                for (; 0 !== d.length;) i = d.substring(0, k), d = d.substring(i.length), j.push(i);
                                for (; i = j.shift();) h.push({
                                    data: j.length + "_" + i,
                                    origin: e,
                                    callback: 0 === j.length ? g : null
                                })
                            } else h.push({
                                data: d,
                                origin: e,
                                callback: g
                            });
                            l ? c.down.init() : b()
                        },
                        destroy: function () {
                            g = !0, c.down.destroy()
                        }
                    }
                }, Stripe.easyXDM = H
        }(window, document, location, window.setTimeout, decodeURIComponent, encodeURIComponent)
    }.call(this),
    function () {
        var a, b = [].slice,
            c = [].indexOf || function (a) {
                for (var b = 0, c = this.length; b < c; b++)
                    if (b in this && this[b] === a) return b;
                return -1
            };
        this.Stripe.isDoubleLoaded || (a = function () {
            function a(a, b, f, g) {
                var h, i, j, k, l, m, n, o;
                if (null == window.ApplePaySession && !g) throw new Error("Apple Pay is not supported in this browser. You should check the result of Stripe.applePay.checkAvailability before trying to create an Apple Pay session.");
                for (i = function (a) {
                        return function (b) {
                            var c;
                            return c = (null != b ? b.error : void 0) || {
                                message: "Something went wrong validating your Apple Pay Session."
                            }, null != c.message && console.warn(c.message), a.session.abort(), "function" == typeof f ? f(c) : void 0
                        }
                    }(this), this.paymentRequest = e(a), k = null != (n = this.paymentRequest.shippingMethods) ? n[0] : void 0, this.session = g || new ApplePaySession(1, this.paymentRequest), j = function (a) {
                        return function (b) {
                            return Object.defineProperty(a, b, {
                                set: function (a) {
                                    if ("onpaymentauthorized" === b || "onvalidatemerchant" === b) throw new Error("Stripe handles this callback for you; you shouldn't set this property yourself. For more help, see https://stripe.com/docs/apple-pay/web#apple-merchant-validation");
                                    return this.session[b] = a
                                },
                                get: function () {
                                    return this.session[b]
                                }
                            })
                        }
                    }(this), o = ["oncancel", "onpaymentauthorized", "onpaymentmethodselected", "onshippingcontactselected", "onshippingmethodselected", "onvalidatemerchant"], l = 0, m = o.length; l < m; l++) h = o[l], j(h);
                this.addEventListener("shippingmethodselected", function (a) {
                    return k = a.shippingMethod
                }), this.addEventListener("validatemerchant", function (b) {
                    return function (c) {
                        var d;
                        return d = {
                            method: "POST",
                            url: "" + Stripe.endpoint + "/apple_pay/sessions",
                            headers: Stripe.applePay.stripeAccount ? {
                                "Stripe-Account": Stripe.applePay.stripeAccount
                            } : {},
                            data: {
                                key: Stripe.key || Stripe.publishableKey,
                                validation_url: c.validationURL,
                                domain_name: window.location.hostname,
                                display_name: a.total.label
                            },
                            success: function (a, c) {
                                var d;
                                return null != a.session ? (d = Stripe.JSON.parse(a.session), b.session.completeMerchantValidation(d)) : i(a)
                            },
                            complete: function (a, b, c) {
                                if ("success" !== a) return i(b)
                            },
                            timeout: 4e4
                        }, Stripe.request(d)
                    }
                }(this)), this.addEventListener("paymentauthorized", function (e) {
                    return function (g) {
                        var h, i, j, l, m;
                        return null != e._stripeSkipTokenizationForDemo ? void e.session.completePayment(ApplePaySession.STATUS_SUCCESS) : (l = g.payment, "simulated identifier" === l.token.transactionIdentifier.toLowerCase() && (h = "4242424242424242", j = a.currencyCode.toLowerCase(), i = Stripe.utils.formatAmountWithCurrency(a.total.amount, j), m = Math.random().toString(36).slice(-10), l.token.transactionIdentifier = ["ApplePayStubs", h, i, j, m].join("~"), l.token.paymentData = h), Stripe.applePay.createToken(l, function (g, h) {
                            var i, j, m, n, o;
                            if (null != h.error) return e.session.completePayment(ApplePaySession.STATUS_FAILURE), "function" == typeof f ? f(h.error) : void 0;
                            if (j = {
                                    token: h
                                }, null != k && (j.shippingMethod = k), null != l.billingContact && (l.billingContact = d(l.billingContact), i = a.requiredBillingContactFields || [], c.call(i, "postalAddress") >= 0 && (null === (n = l.billingContact.countryCode) || void 0 === n || "" === n))) return (new Image).src = "https://q.stripe.com/?event=stripejs-error&type=ApplePayInvalidCountry&" + Stripe.utils.serialize(l.billingContact), void e.session.completePayment(ApplePaySession.STATUS_INVALID_BILLING_POSTAL_ADDRESS);
                            if (null != l.shippingContact) {
                                if (l.shippingContact = d(l.shippingContact), m = a.requiredShippingContactFields || [], c.call(m, "postalAddress") >= 0 && (null === (o = l.shippingContact.countryCode) || void 0 === o || "" === o)) return (new Image).src = "https://q.stripe.com/?event=stripejs-error&type=ApplePayInvalidCountry&" + Stripe.utils.serialize(l.shippingContact), void e.session.completePayment(ApplePaySession.STATUS_INVALID_SHIPPING_POSTAL_ADDRESS);
                                j.shippingContact = l.shippingContact
                            }
                            return b(j, function (a) {
                                return a === ApplePaySession.STATUS_SUCCESS || a === ApplePaySession.STATUS_FAILURE || a === ApplePaySession.STATUS_INVALID_BILLING_POSTAL_ADDRESS || a === ApplePaySession.STATUS_INVALID_SHIPPING_POSTAL_ADDRESS || a === ApplePaySession.STATUS_INVALID_SHIPPING_CONTACT ? e.session.completePayment(a) : a ? e.session.completePayment(ApplePaySession.STATUS_SUCCESS) : e.session.completePayment(ApplePaySession.STATUS_FAILURE)
                            })
                        }))
                    }
                }(this))
            }
            var d, e;
            return e = function (a) {
                return a.supportedNetworks || (a.supportedNetworks = ["amex", "discover", "masterCard", "visa"]), a.merchantCapabilities = ["supports3DS"], a
            }, d = function (a) {
                var b, c, d, e, f;
                return c = {
                    australia: "AU",
                    austria: "AT",
                    canada: "CA",
                    schweiz: "CH",
                    deutschland: "DE",
                    hongkong: "HK",
                    saudiarabia: "SA",
                    espaa: "ES",
                    singapore: "SG",
                    us: "US",
                    usa: "US",
                    unitedstatesofamerica: "US",
                    unitedstates: "US",
                    england: "GB",
                    gb: "GB",
                    uk: "GB",
                    unitedkingdom: "GB"
                }, null !== (e = a.countryCode) && void 0 !== e && "" !== e || (b = null != (f = a.country) && "function" == typeof f.toLowerCase && "function" == typeof (d = f.toLowerCase()).replace ? d.replace(/[^a-z]+/g, "") : void 0, a.countryCode = c[b]), a
            }, a.prototype.completeMerchantValidation = function () {
                throw new Error("Stripe handles calling this method for you; you shouldn't invoke it directly. For more help, see https://stripe.com/docs/apple-pay/web#apple-merchant-validation")
            }, a.prototype.completePayment = function () {
                throw new Error("Stripe handles calling this method for you; you shouldn't invoke it directly. For more help, see https://stripe.com/docs/apple-pay/web#apple-merchant-validation")
            }, a.prototype.abort = function () {
                var a, c;
                return a = 1 <= arguments.length ? b.call(arguments, 0) : [], (c = this.session).abort.apply(c, a)
            }, a.prototype.addEventListener = function () {
                var a, c;
                return a = 1 <= arguments.length ? b.call(arguments, 0) : [], (c = this.session).addEventListener.apply(c, a)
            }, a.prototype.begin = function () {
                var a, c;
                return a = 1 <= arguments.length ? b.call(arguments, 0) : [], (c = this.session).begin.apply(c, a)
            }, a.prototype.completePaymentMethodSelection = function () {
                var a, c;
                return a = 1 <= arguments.length ? b.call(arguments, 0) : [], (c = this.session).completePaymentMethodSelection.apply(c, a)
            }, a.prototype.completeShippingContactSelection = function () {
                var a, c;
                return a = 1 <= arguments.length ? b.call(arguments, 0) : [], (c = this.session).completeShippingContactSelection.apply(c, a)
            }, a.prototype.completeShippingMethodSelection = function () {
                var a, c;
                return a = 1 <= arguments.length ? b.call(arguments, 0) : [], (c = this.session).completeShippingMethodSelection.apply(c, a)
            }, a.prototype.supportsVersion = function () {
                var a, c;
                return a = 1 <= arguments.length ? b.call(arguments, 0) : [], (c = this.session).supportsVersion.apply(c, a)
            }, a
        }(), this.Stripe.ApplePaySession = a)
    }.call(this),
    function () {
        var a = [].indexOf || function (a) {
            for (var b = 0, c = this.length; b < c; b++)
                if (b in this && this[b] === a) return b;
            return -1
        };
        this.Stripe.isDoubleLoaded || (this.Stripe.utils = function () {
            function b() {}
            var c, d;
            return c = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, b.trim = function (a) {
                return null === a ? "" : (a + "").replace(c, "")
            }, b.isArray = function (a) {
                return "[object Array]" === Object.prototype.toString.call(a)
            }, b.serialize = function (a, b, c) {
                var d, e, f;
                null == b && (b = []);
                try {
                    for (e in a) f = a[e], c && (e = "" + c + "[" + e + "]"), "object" == typeof f ? this.serialize(f, b, e) : b.push("" + e + "=" + encodeURIComponent(f));
                    return b.join("&").replace(/%20/g, "+")
                } catch (g) {
                    throw d = g, new Error("Unable to serialize: " + a)
                }
            }, b.underscore = function (a) {
                return (a + "").replace(/([A-Z])/g, function (a) {
                    return "_" + a.toLowerCase()
                }).replace(/-/g, "_")
            }, b.underscoreKeys = function (a) {
                var b, c, d;
                d = [];
                for (b in a) c = a[b], delete a[b], d.push(a[this.underscore(b)] = c);
                return d
            }, b.isElement = function (a) {
                return "object" == typeof a && (!!a.jquery || 1 === a.nodeType)
            }, b.addClass = function (a, b) {
                return a.className = this._removedClassString(a, b) + " " + b
            }, b.removeClass = function (a, b) {
                return a.className = this._removedClassString(a, b)
            }, b._removedClassString = function (a, b) {
                return Stripe.utils.trim(a.className.replace(new RegExp("( |^)" + b + "( |$)", "g"), " "))
            }, b.paramsFromForm = function (b, c) {
                var d, e, f, g, h, i, j, k, l, m;
                for (null == c && (c = []), b.jquery && (b = b[0]), f = b.getElementsByTagName("input"), h = b.getElementsByTagName("select"), i = {}, j = 0, l = f.length; j < l; j++) e = f[j], d = this.underscore(e.getAttribute("data-stripe")), a.call(c, d) < 0 || (i[d] = e.value);
                for (k = 0, m = h.length; k < m; k++) g = h[k], d = this.underscore(g.getAttribute("data-stripe")), a.call(c, d) < 0 || null != g.selectedIndex && (i[d] = g.options[g.selectedIndex].value);
                return i
            }, b.validateProtocol = function (a) {
                var b;
                if (a && "string" == typeof a) return /_live_/g.test(a) && "https:" !== window.location.protocol && null != (null != (b = window.console) ? b.warn : void 0) ? window.console.warn("You are using Stripe.js in live mode over an insecure connection. This is considered unsafe. Please conduct live requests only on sites served over https. For more info, see https://stripe.com/help/ssl") : void 0
            }, b.validateKey = function (a) {
                if (!a || "string" != typeof a) throw new Error("You did not set a valid publishable key. Call Stripe.setPublishableKey() with your publishable key. For more info, see https://stripe.com/docs/stripe.js");
                if (/\s/g.test(a)) throw new Error("Your key is invalid, as it contains whitespace. For more info, see https://stripe.com/docs/stripe.js");
                if (/^sk_/.test(a)) throw new Error("You are using a secret key with Stripe.js, instead of the publishable one. For more info, see https://stripe.com/docs/stripe.js")
            }, b.parseExpString = function (a) {
                var b, c, d, e, f, g, h, i, j;
                for (g = function (b) {
                        throw new Error("You passed an invalid expiration date `" + a + "`. " + (b || "") + "Please pass a string containing a numeric month and year such as `01-17` or `2015 / 05` For more info, see https://stripe.com/docs/stripe.js")
                    }, "string" != typeof a && g(), f = a.split(/[\.\-\/\s]+/g), 2 !== f.length && g(), b = i = 0, j = f.length; i < j; b = ++i) e = f[b], d = parseInt(e), isNaN(d) && g("" + f + " is not a number. "), d < 1 && g("" + d + " is less than one. "), f[b] = d;
                return f[0] > 12 ? (h = f[0], c = f[1]) : (c = f[0], h = f[1]), c > 12 && g("Month must be a number 1-12, not " + c + ". "), h < 100 && (h += 2e3), [c, h]
            }, b.formatAmountWithCurrency = function (b, c) {
                var d, e, f;
                return d = parseFloat(b), e = ["bif", "clp", "djf", "gnf", "jpy", "kmf", "krw", "mga", "pyg", "rwf", "vnd", "vuv", "xaf", "xof", "xpf"], f = c.toLowerCase(), a.call(e, f) < 0 && (d = Math.round(100 * d)), parseInt(d)
            }, b.generateID = function () {
                return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (a) {
                    var b, c;
                    return b = 16 * Math.random() | 0, c = "x" === a ? b : 3 & b | 8, c.toString(16)
                })
            }, b.setCookie = function (a, b, c) {
                var d, e, f;
                return null == c && (c = {}), e = new Date, f = c.expiresIn || 31536e6, e.setTime(e.getTime() + f), null == c.path && (c.path = "/"), b = (b + "").replace(/[^!#-+\--:<-\[\]-~]/g, encodeURIComponent), d = "" + encodeURIComponent(a) + "=" + b + ";expires=" + e.toGMTString() + ";path=" + c.path + ";SameSite=Lax", c.domain && (d += ";domain=" + c.domain), document.cookie = d
            }, b.getCookie = function (a) {
                var b, c, d, e, f, g, h;
                for (c = document.cookie.split("; "), g = 0, h = c.length; g < h; g++)
                    if (b = c[g], d = b.indexOf("="), e = decodeURIComponent(b.substr(0, d)), f = decodeURIComponent(b.substr(d + 1)), e === a) return f;
                return null
            }, b.isServerGeneratedId = function (a) {
                return 42 === a.length
            }, b.determineId = function (a, b) {
                return !a || !this.isServerGeneratedId(a) && this.isServerGeneratedId(b) ? b : a
            }, b.getMerchantID = function () {
                var a, b, c;
                try {
                    return b = this.determineId(this.getCookie("__stripe_mid"), (null != (c = Stripe.__mids) ? c.muid : void 0) || "NA"), this.isServerGeneratedId(b) && this.setCookie("__stripe_mid", b, {
                        domain: "." + document.location.hostname
                    }), b
                } catch (d) {
                    return a = d, "NA"
                }
            }, b.getStripeID = function () {
                var a;
                try {
                    return Stripe.__mids.guid || "NA"
                } catch (b) {
                    return a = b, "NA"
                }
            }, b.getSessionID = function () {
                var a, b, c, d;
                try {
                    return b = this.determineId(this.getCookie("__stripe_sid"), (null != (d = Stripe.__mids) ? d.sid : void 0) || "NA"), this.isServerGeneratedId(b) && (c = {
                        domain: "." + document.location.hostname,
                        expiresIn: 18e5
                    }, this.setCookie("__stripe_sid", b, c)), b
                } catch (e) {
                    return a = e, "NA"
                }
            }, b.addAdditionalParams = function (a) {
                var b;
                if (null == a.guid && (a.guid = "EMPTY"), null == a.muid && (a.muid = "EMPTY"), null == a.sid && (a.sid = "EMPTY"), true) try {
                    "EMPTY" === a.guid && (a.guid = Stripe.utils.getStripeID()), "EMPTY" === a.muid && (a.muid = Stripe.utils.getMerchantID()), "EMPTY" === a.sid && (a.sid = Stripe.utils.getSessionID())
                } catch (c) {
                    b = c, Stripe.reportError("DeviceIdError-Extraction")
                }
                return a
            }, d = new RegExp("^(99999|A9A 9A9|AA9A 9AA|A9A 9AA|A9 9AA|A99 9AA|AA9 9AA|AA99 9AA)$".replace(/A/g, "[a-zA-Z]").replace(/9/g, "\\d").replace(/\s+/g, "\\s*")), b.typeOfString = function (a) {
                var b;
                a = this.trim(a);
                try {
                    if (/^\d{3,4}$/.test(a)) return "cvc";
                    if (d.test(a)) return "zip";
                    if (/^.+@.+\..+$/.test(a)) return "email";
                    if (/^\d{15,17}$/.test(a.replace(/\s+/g, ""))) return "number"
                } catch (c) {
                    return b = c, null
                }
            }, b
        }())
    }.call(this),
    function () {
        var a;
        a = (new Date).getTime(), this.Stripe.isDoubleLoaded || (this.Stripe.ajaxJSONP = function (a) {
            return null == a && (a = {}), this.xhr(a)
        })
    }.call(this),
    function () {
        var a, b, c, d, e, f, g, h, i, j = {}.hasOwnProperty;
        this.Stripe.isDoubleLoaded || (b = {
            contentType: "application/x-www-form-urlencoded",
            accept: {
                json: "application/json"
            }
        }, g = /^(20\d|1223)$/, f = "invalid_json_response", d = function (a, b, c) {
            return function () {
                return a._aborted ? c(a.request, "abort") : a.request && 4 === a.request.readyState ? (a.request.onreadystatechange = function () {}, 0 === a.request.status ? c(a.request, "empty_response") : g.test(a.request.status) ? b(a.request, a.request.status) : b(a.request, a.request.status)) : void 0
            }
        }, h = function (a, c) {
            var d, e, f, g, h;
            f = c.headers || {}, f.Accept || (f.Accept = b.accept.json), f["Content-Type"] || (f["Content-Type"] = b.contentType), g = c._globalCustomHeaders;
            for (d in g) j.call(g, d) && "setRequestHeader" in a && a.setRequestHeader(d, c._globalCustomHeaders[d]);
            h = [];
            for (e in f) j.call(f, e) && ("setRequestHeader" in a ? h.push(a.setRequestHeader(e, f[e])) : h.push(void 0));
            return h
        }, i = function (a, b) {
            return /\?/.test(a) ? a + "&" + b : a + "?" + b
        }, c = function (a, b) {
            var c, e, f, g, j, k, l, m, n;
            k = this.o, j = (k.method || "GET").toUpperCase(), l = k.url, g = null != (m = k.data) ? m.key : void 0, c = Stripe.utils.serialize(k.data), f = void 0, "GET" === j && c && (l = i(l, c), c = null), n = new XMLHttpRequest, n.open(j, l, !0), h(n, k), n.onreadystatechange = d(this, a, b);
            try {
                n.send(c)
            } catch (o) {
                e = o, Stripe.reportError("XHR-" + e.toString()), b(n, "xhr_send_failure")
            }
            return n
        }, a = function (a) {
            return this.o = a, e.apply(this, arguments)
        }, e = function (a) {
            var b, d, e;
            return this.url = a.url, this.timeout = null, this._successHandler = function () {}, this._errorHandlers = [], this._completeHandlers = [], a.timeout && (this.timeout = setTimeout(function (a) {
                return function () {
                    return a.abort()
                }
            }(this), a.timeout)), a.success && (this._successHandler = function () {
                return a.success.apply(a, arguments)
            }), a.error && this._errorHandlers.push(function () {
                return a.error.apply(a, arguments)
            }), a.complete && this._completeHandlers.push(function () {
                return a.complete.apply(a, arguments)
            }), b = function (b) {
                return function (c, d) {
                    var e;
                    for (a.timeout && clearTimeout(b.timeout), b.timeout = null, e = []; b._completeHandlers.length > 0;) e.push(b._completeHandlers.shift()(d, c, a));
                    return e
                }
            }(this), e = function (a) {
                return function (c, e) {
                    var g, h, i;
                    if (i = c.responseText, i && i.length) {
                        h = void 0;
                        try {
                            h = Stripe.JSON.parse(i)
                        } catch (j) {
                            return g = j, d(c, f)
                        }
                        return a._successHandler(h, e, c), b(h, "success")
                    }
                    return d(c, "empty_response")
                }
            }(this), d = function (a) {
                return function (c, d) {
                    var e, g, h;
                    if (h = c.responseText, g = void 0, h && h.length && d !== f) try {
                        g = Stripe.JSON.parse(h)
                    } catch (i) {
                        e = i, d = d + "_AND_" + f
                    }
                    for (; a._errorHandlers.length > 0;) a._errorHandlers.shift()(g || c, d);
                    return b(g, d)
                }
            }(this), this.request = c.call(this, e, d)
        }, a.prototype = {
            abort: function () {
                var a;
                return this._aborted = !0, null != (a = this.request) ? a.abort() : void 0
            }
        }, this.Stripe.xhr = function (b) {
            return b._globalCustomHeaders = this._customHeaders, new a(b)
        })
    }.call(this),
    function () {
        var a, b, c, d, e = {}.hasOwnProperty;
        this.Stripe.isDoubleLoaded || (a = function (a) {
            return this.options = a, a.requestId = Stripe._callCount, a.endpoint = Stripe.endpoint, a.trackPerf = Stripe.trackPerf, this.iframeTimeout = setTimeout(function () {
                return Stripe._fallBackToOldStripeJsTechniques(), Stripe._iframePendingRequests[a.requestId] && (Stripe.request(Stripe._iframePendingRequests[a.requestId], !0), delete Stripe._iframePendingRequests[a.requestId]), Stripe._callCache[a.requestId] = function () {
                    return Stripe.reportError("TimeoutEventualReturnError")
                }
            }, 1e4), Stripe._iframePendingRequests[a.requestId] = a, Stripe._callCache[a.requestId] = function (b) {
                return function () {
                    return clearTimeout(b.iframeTimeout), delete Stripe._iframePendingRequests[a.requestId], a.success.apply(a, arguments), "function" == typeof a.complete ? a.complete("success", null, a) : void 0
                }
            }(this), Stripe._callCount += 1, Stripe._socket.postMessage(Stripe.JSON.stringify(a))
        }, this.Stripe.iframe = function (b) {
            return new a(b)
        }, c = Stripe.easyXDM, this.Stripe._isChannel ? Stripe._socket = new c.Socket({
            swf: "" + Stripe._iframeBaseUrl + "/v2/stripexdm.swf",
            onMessage: Stripe._channelListener
        }) : Stripe._isSafeDomain || (d = function (a) {
            var b, c, e;
            "console" in window && "warn" in window.console, 1, Stripe._iframeChannelComplete.call(Stripe, !1), Stripe._callCache = {}, Stripe.reportError("FB-" + a), c = document.createElement("script"), e = Math.round((new Date).getTime() / 1e3), c.src = "" + Stripe._iframeBaseUrl + "/v2/cspblocked.js?domain=" + encodeURIComponent(document.location.href) + "&timestamp=" + e + "&info=" + encodeURIComponent(a) + "&payment_user_agent=" + encodeURIComponent(Stripe.stripejs_ua), b = document.getElementsByTagName("script")[0], b.parentNode.insertBefore(c, b), d = function () {}
        }, b = "", Stripe._socket = new c.Socket({
            swf: "" + Stripe._iframeBaseUrl + "/v2/stripexdm.swf",
            remote: "" + Stripe._iframeBaseUrl + "/v2" + b + "/channel" + (Stripe.accountDetails ? "-provisioning" : "") + ".html#__stripe_transport__",
            onMessage: Stripe._receiveChannelRelay,
            ackTimeoutDuration: 1e4,
            onLoad: function () {
                return this._socketLoadTime = +new Date, this.onError = function () {}, this.onAsyncInject = function () {}, clearTimeout(this.injectTimeout), this._socketAckTime ? this.loadTimeout ? (clearTimeout(this.loadTimeout), Stripe._iframeChannelComplete.call(Stripe, !0)) : Stripe.reportError("LoadDelayError", this._socketLoadTime - this._socketAckTime) : this.ackTimeout = setTimeout(function (a) {
                    return function () {
                        return a.onFrameAck = function () {}, clearTimeout(a.loadTimeout), d("AckTimeoutError")
                    }
                }(this), this.ackTimeoutDuration)
            },
            onError: function () {
                return this.onLoad = function () {}, this.onAsyncInject = function () {}, this.onFrameAck = function () {}, clearTimeout(this.ackTimeout), clearTimeout(this.injectTimeout), clearTimeout(this.loadTimeout), d("IframeOnError")
            },
            onInternalError: function (a) {
                var b, c, d;
                this.onError = function () {}, this.onLoad = function () {}, this.onFrameAck = function () {}, this.onAsyncInject = function () {}, clearTimeout(this.ackTimeout), clearTimeout(this.loadTimeout), clearTimeout(this.injectTimeout), Stripe.reportError("FB-XDM-" + a), Stripe._fallBackToOldStripeJsTechniques(), d = Stripe._iframePendingRequests;
                for (b in d) e.call(d, b) && (c = d[b], Stripe._callCache[c.requestId] = function () {}, delete Stripe._iframePendingRequests[c.requestId], Stripe.request(c, !0))
            },
            onAsyncInject: function (a) {
                return this.injectTimeout = setTimeout(function (a) {
                    return function () {
                        return a.onError = function () {}, a.onLoad = function () {}, a.onFrameAck = function () {}, clearTimeout(a.ackTimeout), clearTimeout(a.loadTimeout), d("InjectTimeoutError")
                    }
                }(this), this.ackTimeoutDuration)
            },
            onFrameAck: function (a) {
                return this._socketAckTime = +new Date, clearTimeout(this.ackTimeout), clearTimeout(this.injectTimeout), this.onAsyncInject = function () {}, this.onError = function () {}, this.ackTimeout ? Stripe._iframeChannelComplete.call(Stripe, !0) : this._socketLoadTime ? (this.onLoad = function () {}, Stripe.reportError("AckDelayError", this._socketAckTime - this._socketLoadTime)) : this.loadTimeout = setTimeout(function (a) {
                    return function () {
                        return d("LoadTimeoutError"), a.onLoad = function () {}
                    }
                }(this), this.ackTimeoutDuration)
            }
        })))
    }.call(this),
    function () {
        var a = [].indexOf || function (a) {
            for (var b = 0, c = this.length; b < c; b++)
                if (b in this && this[b] === a) return b;
            return -1
        };
        this.Stripe.isDoubleLoaded || (this.Stripe.validator = {
            "boolean": function (a, b) {
                if ("true" !== b && "false" !== b) return "Enter a boolean string (true or false)"
            },
            integer: function (a, b) {
                if (!/^\d+$/.test(b)) return "Enter an integer"
            },
            positive: function (a, b) {
                if (this.integer(a, b) || !(parseInt(b, 10) > 0)) return "Enter a positive value"
            },
            range: function (b, c) {
                var d;
                if (d = parseInt(c, 10), a.call(b, d) < 0) return "Needs to be between " + b[0] + " and " + b[b.length - 1]
            },
            required: function (a, b) {
                if (a && (null == b || "" === b)) return "Required"
            },
            year: function (a, b) {
                if (!/^\d{4}$/.test(b)) return "Enter a 4-digit year"
            },
            birthYear: function (a, b) {
                var c;
                return c = this.year(a, b), c ? c : parseInt(b, 10) > 2e3 ? "You must be over 18" : parseInt(b, 10) < 1900 ? "Enter your birth year" : void 0
            },
            month: function (a, b) {
                return this.integer(a, b) ? "Please enter a month" : this.range([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12], b) ? "Needs to be between 1 and 12" : void 0
            },
            choices: function (b, c) {
                if (a.call(b, c) < 0) return "Not an acceptable value for this field"
            },
            email: function (a, b) {
                if (!/^[^@<\s>]+@[^@<\s>]+$/.test(b)) return "That doesn't look like an email address"
            },
            url: function (a, b) {
                if (!/^https?:\/\/.+\..+/.test(b)) return "Not a valid url"
            },
            usTaxID: function (a, b) {
                if (!/^\d{2}-?\d{1}-?\d{2}-?\d{4}$/.test(b)) return "Not a valid tax ID"
            },
            ein: function (a, b) {
                if (!/^\d{2}-?\d{7}$/.test(b)) return "Not a valid EIN"
            },
            ssnLast4: function (a, b) {
                if (!/^\d{4}$/.test(b)) return "Not a valid last 4 digits for an SSN"
            },
            ownerPersonalID: function (a, b) {
                var c;
                if (c = function () {
                        switch (a) {
                            case "CA":
                                return /^\d{3}-?\d{3}-?\d{3}$/.test(b);
                            case "US":
                                return !0
                        }
                    }(), !c) return "Not a valid ID"
            },
            bizTaxID: function (a, b) {
                var c, d, e, f, g, h, i, j;
                if (h = {
                        CA: ["Tax ID", [/^\d{9}$/]],
                        US: ["EIN", [/^\d{2}-?\d{7}$/]]
                    }, g = h[a], null != g) {
                    for (c = g[0], f = g[1], d = !1, i = 0, j = f.length; i < j; i++)
                        if (e = f[i], e.test(b)) {
                            d = !0;
                            break
                        } if (!d) return "Not a valid " + c
                }
            },
            zip: function (a, b) {
                var c;
                if (c = function () {
                        switch (a.toUpperCase()) {
                            case "CA":
                                return /^[\d\w]{6}$/.test(null != b ? b.replace(/\s+/g, "") : void 0);
                            case "US":
                                return /^\d{5}$/.test(b) || /^\d{9}$/.test(b)
                        }
                    }(), !c) return "Not a valid zip"
            },
            bankAccountNumber: function (a, b) {
                if (!/^\d{1,17}$/.test(b)) return "Invalid bank account number"
            },
            usRoutingNumber: function (a) {
                var b, c, d, e, f, g, h;
                if (!/^\d{9}$/.test(a)) return "Routing number must have 9 digits";
                for (f = 0, b = g = 0, h = a.length - 1; g <= h; b = g += 3) c = 3 * parseInt(a.charAt(b), 10), d = 7 * parseInt(a.charAt(b + 1), 10), e = parseInt(a.charAt(b + 2), 10), f += c + d + e;
                return 0 === f || f % 10 !== 0 ? "Invalid routing number" : void 0
            },
            caRoutingNumber: function (a) {
                if (!/^\d{5}\-\d{3}$/.test(a)) return "Invalid transit number"
            },
            routingNumber: function (a, b) {
                switch (a.toUpperCase()) {
                    case "CA":
                        return this.caRoutingNumber(b);
                    case "US":
                        return this.usRoutingNumber(b)
                }
            },
            phoneNumber: function (a, b) {
                var c;
                if (c = b.replace(/[^0-9]/g, ""), 10 !== c.length) return "Invalid phone number"
            },
            bizDBA: function (a, b) {
                if (!/^.{1,23}$/.test(b)) return "Statement descriptors can only have up to 23 characters"
            },
            nameLength: function (a, b) {
                if (1 === b.length) return "Names need to be longer than one character"
            },
            isUrl: function (a) {
                return "string" == typeof a && !this.url(null, a)
            },
            isElementOrId: function (a) {
                return "object" == typeof a && null != a.appendChild || "string" == typeof a
            }
        })
    }.call(this);