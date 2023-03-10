! function(e, t) {
    "use strict";
    "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function(e) {
        if (!e.document) throw new Error("jQuery requires a window with a document");
        return t(e)
    } : t(e)
}("undefined" != typeof window ? window : this, function(S, e) {
    "use strict";
    var t = [],
        T = S.document,
        i = Object.getPrototypeOf,
        a = t.slice,
        g = t.concat,
        l = t.push,
        o = t.indexOf,
        n = {},
        r = n.toString,
        m = n.hasOwnProperty,
        s = m.toString,
        c = s.call(Object),
        v = {},
        y = function(e) {
            return "function" == typeof e && "number" != typeof e.nodeType
        },
        b = function(e) {
            return null != e && e === e.window
        },
        u = {
            type: !0,
            src: !0,
            noModule: !0
        };

    function w(e, t, n) {
        var i, o = (t = t || T).createElement("script");
        if (o.text = e, n)
            for (i in u) n[i] && (o[i] = n[i]);
        t.head.appendChild(o).parentNode.removeChild(o)
    }

    function x(e) {
        return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? n[r.call(e)] || "object" : typeof e
    }
    var C = function(e, t) {
            return new C.fn.init(e, t)
        },
        d = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;

    function p(e) {
        var t = !!e && "length" in e && e.length,
            n = x(e);
        return !y(e) && !b(e) && ("array" === n || 0 === t || "number" == typeof t && 0 < t && t - 1 in e)
    }
    C.fn = C.prototype = {
        jquery: "3.3.1",
        constructor: C,
        length: 0,
        toArray: function() {
            return a.call(this)
        },
        get: function(e) {
            return null == e ? a.call(this) : e < 0 ? this[e + this.length] : this[e]
        },
        pushStack: function(e) {
            var t = C.merge(this.constructor(), e);
            return t.prevObject = this, t
        },
        each: function(e) {
            return C.each(this, e)
        },
        map: function(n) {
            return this.pushStack(C.map(this, function(e, t) {
                return n.call(e, t, e)
            }))
        },
        slice: function() {
            return this.pushStack(a.apply(this, arguments))
        },
        first: function() {
            return this.eq(0)
        },
        last: function() {
            return this.eq(-1)
        },
        eq: function(e) {
            var t = this.length,
                n = +e + (e < 0 ? t : 0);
            return this.pushStack(0 <= n && n < t ? [this[n]] : [])
        },
        end: function() {
            return this.prevObject || this.constructor()
        },
        push: l,
        sort: t.sort,
        splice: t.splice
    }, C.extend = C.fn.extend = function() {
        var e, t, n, i, o, r, s = arguments[0] || {},
            a = 1,
            l = arguments.length,
            c = !1;
        for ("boolean" == typeof s && (c = s, s = arguments[a] || {}, a++), "object" == typeof s || y(s) || (s = {}), a === l && (s = this, a--); a < l; a++)
            if (null != (e = arguments[a]))
                for (t in e) n = s[t], s !== (i = e[t]) && (c && i && (C.isPlainObject(i) || (o = Array.isArray(i))) ? (o ? (o = !1, r = n && Array.isArray(n) ? n : []) : r = n && C.isPlainObject(n) ? n : {}, s[t] = C.extend(c, r, i)) : void 0 !== i && (s[t] = i));
        return s
    }, C.extend({
        expando: "jQuery" + ("3.3.1" + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(e) {
            throw new Error(e)
        },
        noop: function() {},
        isPlainObject: function(e) {
            var t, n;
            return !(!e || "[object Object]" !== r.call(e) || (t = i(e)) && ("function" != typeof(n = m.call(t, "constructor") && t.constructor) || s.call(n) !== c))
        },
        isEmptyObject: function(e) {
            var t;
            for (t in e) return !1;
            return !0
        },
        globalEval: function(e) {
            w(e)
        },
        each: function(e, t) {
            var n, i = 0;
            if (p(e))
                for (n = e.length; i < n && !1 !== t.call(e[i], i, e[i]); i++);
            else
                for (i in e)
                    if (!1 === t.call(e[i], i, e[i])) break;
            return e
        },
        trim: function(e) {
            return null == e ? "" : (e + "").replace(d, "")
        },
        makeArray: function(e, t) {
            var n = t || [];
            return null != e && (p(Object(e)) ? C.merge(n, "string" == typeof e ? [e] : e) : l.call(n, e)), n
        },
        inArray: function(e, t, n) {
            return null == t ? -1 : o.call(t, e, n)
        },
        merge: function(e, t) {
            for (var n = +t.length, i = 0, o = e.length; i < n; i++) e[o++] = t[i];
            return e.length = o, e
        },
        grep: function(e, t, n) {
            for (var i = [], o = 0, r = e.length, s = !n; o < r; o++) !t(e[o], o) !== s && i.push(e[o]);
            return i
        },
        map: function(e, t, n) {
            var i, o, r = 0,
                s = [];
            if (p(e))
                for (i = e.length; r < i; r++) null != (o = t(e[r], r, n)) && s.push(o);
            else
                for (r in e) null != (o = t(e[r], r, n)) && s.push(o);
            return g.apply([], s)
        },
        guid: 1,
        support: v
    }), "function" == typeof Symbol && (C.fn[Symbol.iterator] = t[Symbol.iterator]), C.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function(e, t) {
        n["[object " + t + "]"] = t.toLowerCase()
    });
    var f = function(n) {
        var e, f, w, r, o, h, d, g, x, l, c, k, S, s, T, m, a, u, v, C = "sizzle" + 1 * new Date,
            y = n.document,
            E = 0,
            i = 0,
            p = se(),
            b = se(),
            A = se(),
            $ = function(e, t) {
                return e === t && (c = !0), 0
            },
            N = {}.hasOwnProperty,
            t = [],
            O = t.pop,
            D = t.push,
            j = t.push,
            L = t.slice,
            P = function(e, t) {
                for (var n = 0, i = e.length; n < i; n++)
                    if (e[n] === t) return n;
                return -1
            },
            H = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            M = "[\\x20\\t\\r\\n\\f]",
            q = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
            I = "\\[" + M + "*(" + q + ")(?:" + M + "*([*^$|!~]?=)" + M + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + q + "))|)" + M + "*\\]",
            F = ":(" + q + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + I + ")*)|.*)\\)|)",
            _ = new RegExp(M + "+", "g"),
            z = new RegExp("^" + M + "+|((?:^|[^\\\\])(?:\\\\.)*)" + M + "+$", "g"),
            W = new RegExp("^" + M + "*," + M + "*"),
            R = new RegExp("^" + M + "*([>+~]|" + M + ")" + M + "*"),
            U = new RegExp("=" + M + "*([^\\]'\"]*?)" + M + "*\\]", "g"),
            B = new RegExp(F),
            V = new RegExp("^" + q + "$"),
            X = {
                ID: new RegExp("^#(" + q + ")"),
                CLASS: new RegExp("^\\.(" + q + ")"),
                TAG: new RegExp("^(" + q + "|[*])"),
                ATTR: new RegExp("^" + I),
                PSEUDO: new RegExp("^" + F),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + M + "*(even|odd|(([+-]|)(\\d*)n|)" + M + "*(?:([+-]|)" + M + "*(\\d+)|))" + M + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + H + ")$", "i"),
                needsContext: new RegExp("^" + M + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + M + "*((?:-\\d)?\\d*)" + M + "*\\)|)(?=[^-]|$)", "i")
            },
            Y = /^(?:input|select|textarea|button)$/i,
            K = /^h\d$/i,
            Q = /^[^{]+\{\s*\[native \w/,
            G = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            J = /[+~]/,
            Z = new RegExp("\\\\([\\da-f]{1,6}" + M + "?|(" + M + ")|.)", "ig"),
            ee = function(e, t, n) {
                var i = "0x" + t - 65536;
                return i != i || n ? t : i < 0 ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
            },
            te = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
            ne = function(e, t) {
                return t ? "\0" === e ? "???" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e
            },
            ie = function() {
                k()
            },
            oe = ye(function(e) {
                return !0 === e.disabled && ("form" in e || "label" in e)
            }, {
                dir: "parentNode",
                next: "legend"
            });
        try {
            j.apply(t = L.call(y.childNodes), y.childNodes), t[y.childNodes.length].nodeType
        } catch (n) {
            j = {
                apply: t.length ? function(e, t) {
                    D.apply(e, L.call(t))
                } : function(e, t) {
                    for (var n = e.length, i = 0; e[n++] = t[i++];);
                    e.length = n - 1
                }
            }
        }

        function re(e, t, n, i) {
            var o, r, s, a, l, c, u, d = t && t.ownerDocument,
                p = t ? t.nodeType : 9;
            if (n = n || [], "string" != typeof e || !e || 1 !== p && 9 !== p && 11 !== p) return n;
            if (!i && ((t ? t.ownerDocument || t : y) !== S && k(t), t = t || S, T)) {
                if (11 !== p && (l = G.exec(e)))
                    if (o = l[1]) {
                        if (9 === p) {
                            if (!(s = t.getElementById(o))) return n;
                            if (s.id === o) return n.push(s), n
                        } else if (d && (s = d.getElementById(o)) && v(t, s) && s.id === o) return n.push(s), n
                    } else {
                        if (l[2]) return j.apply(n, t.getElementsByTagName(e)), n;
                        if ((o = l[3]) && f.getElementsByClassName && t.getElementsByClassName) return j.apply(n, t.getElementsByClassName(o)), n
                    }
                if (f.qsa && !A[e + " "] && (!m || !m.test(e))) {
                    if (1 !== p) d = t, u = e;
                    else if ("object" !== t.nodeName.toLowerCase()) {
                        for ((a = t.getAttribute("id")) ? a = a.replace(te, ne) : t.setAttribute("id", a = C), r = (c = h(e)).length; r--;) c[r] = "#" + a + " " + ve(c[r]);
                        u = c.join(","), d = J.test(e) && ge(t.parentNode) || t
                    }
                    if (u) try {
                        return j.apply(n, d.querySelectorAll(u)), n
                    } catch (e) {} finally {
                        a === C && t.removeAttribute("id")
                    }
                }
            }
            return g(e.replace(z, "$1"), t, n, i)
        }

        function se() {
            var i = [];
            return function e(t, n) {
                return i.push(t + " ") > w.cacheLength && delete e[i.shift()], e[t + " "] = n
            }
        }

        function ae(e) {
            return e[C] = !0, e
        }

        function le(e) {
            var t = S.createElement("fieldset");
            try {
                return !!e(t)
            } catch (e) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t), t = null
            }
        }

        function ce(e, t) {
            for (var n = e.split("|"), i = n.length; i--;) w.attrHandle[n[i]] = t
        }

        function ue(e, t) {
            var n = t && e,
                i = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
            if (i) return i;
            if (n)
                for (; n = n.nextSibling;)
                    if (n === t) return -1;
            return e ? 1 : -1
        }

        function de(t) {
            return function(e) {
                return "input" === e.nodeName.toLowerCase() && e.type === t
            }
        }

        function pe(n) {
            return function(e) {
                var t = e.nodeName.toLowerCase();
                return ("input" === t || "button" === t) && e.type === n
            }
        }

        function fe(t) {
            return function(e) {
                return "form" in e ? e.parentNode && !1 === e.disabled ? "label" in e ? "label" in e.parentNode ? e.parentNode.disabled === t : e.disabled === t : e.isDisabled === t || e.isDisabled !== !t && oe(e) === t : e.disabled === t : "label" in e && e.disabled === t
            }
        }

        function he(s) {
            return ae(function(r) {
                return r = +r, ae(function(e, t) {
                    for (var n, i = s([], e.length, r), o = i.length; o--;) e[n = i[o]] && (e[n] = !(t[n] = e[n]))
                })
            })
        }

        function ge(e) {
            return e && void 0 !== e.getElementsByTagName && e
        }
        for (e in f = re.support = {}, o = re.isXML = function(e) {
                var t = e && (e.ownerDocument || e).documentElement;
                return !!t && "HTML" !== t.nodeName
            }, k = re.setDocument = function(e) {
                var t, n, i = e ? e.ownerDocument || e : y;
                return i !== S && 9 === i.nodeType && i.documentElement && (s = (S = i).documentElement, T = !o(S), y !== S && (n = S.defaultView) && n.top !== n && (n.addEventListener ? n.addEventListener("unload", ie, !1) : n.attachEvent && n.attachEvent("onunload", ie)), f.attributes = le(function(e) {
                    return e.className = "i", !e.getAttribute("className")
                }), f.getElementsByTagName = le(function(e) {
                    return e.appendChild(S.createComment("")), !e.getElementsByTagName("*").length
                }), f.getElementsByClassName = Q.test(S.getElementsByClassName), f.getById = le(function(e) {
                    return s.appendChild(e).id = C, !S.getElementsByName || !S.getElementsByName(C).length
                }), f.getById ? (w.filter.ID = function(e) {
                    var t = e.replace(Z, ee);
                    return function(e) {
                        return e.getAttribute("id") === t
                    }
                }, w.find.ID = function(e, t) {
                    if (void 0 !== t.getElementById && T) {
                        var n = t.getElementById(e);
                        return n ? [n] : []
                    }
                }) : (w.filter.ID = function(e) {
                    var n = e.replace(Z, ee);
                    return function(e) {
                        var t = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                        return t && t.value === n
                    }
                }, w.find.ID = function(e, t) {
                    if (void 0 !== t.getElementById && T) {
                        var n, i, o, r = t.getElementById(e);
                        if (r) {
                            if ((n = r.getAttributeNode("id")) && n.value === e) return [r];
                            for (o = t.getElementsByName(e), i = 0; r = o[i++];)
                                if ((n = r.getAttributeNode("id")) && n.value === e) return [r]
                        }
                        return []
                    }
                }), w.find.TAG = f.getElementsByTagName ? function(e, t) {
                    return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : f.qsa ? t.querySelectorAll(e) : void 0
                } : function(e, t) {
                    var n, i = [],
                        o = 0,
                        r = t.getElementsByTagName(e);
                    if ("*" === e) {
                        for (; n = r[o++];) 1 === n.nodeType && i.push(n);
                        return i
                    }
                    return r
                }, w.find.CLASS = f.getElementsByClassName && function(e, t) {
                    if (void 0 !== t.getElementsByClassName && T) return t.getElementsByClassName(e)
                }, a = [], m = [], (f.qsa = Q.test(S.querySelectorAll)) && (le(function(e) {
                    s.appendChild(e).innerHTML = "<a id='" + C + "'></a><select id='" + C + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && m.push("[*^$]=" + M + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || m.push("\\[" + M + "*(?:value|" + H + ")"), e.querySelectorAll("[id~=" + C + "-]").length || m.push("~="), e.querySelectorAll(":checked").length || m.push(":checked"), e.querySelectorAll("a#" + C + "+*").length || m.push(".#.+[+~]")
                }), le(function(e) {
                    e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                    var t = S.createElement("input");
                    t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && m.push("name" + M + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && m.push(":enabled", ":disabled"), s.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && m.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), m.push(",.*:")
                })), (f.matchesSelector = Q.test(u = s.matches || s.webkitMatchesSelector || s.mozMatchesSelector || s.oMatchesSelector || s.msMatchesSelector)) && le(function(e) {
                    f.disconnectedMatch = u.call(e, "*"), u.call(e, "[s!='']:x"), a.push("!=", F)
                }), m = m.length && new RegExp(m.join("|")), a = a.length && new RegExp(a.join("|")), t = Q.test(s.compareDocumentPosition), v = t || Q.test(s.contains) ? function(e, t) {
                    var n = 9 === e.nodeType ? e.documentElement : e,
                        i = t && t.parentNode;
                    return e === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i)))
                } : function(e, t) {
                    if (t)
                        for (; t = t.parentNode;)
                            if (t === e) return !0;
                    return !1
                }, $ = t ? function(e, t) {
                    if (e === t) return c = !0, 0;
                    var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
                    return n || (1 & (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1) || !f.sortDetached && t.compareDocumentPosition(e) === n ? e === S || e.ownerDocument === y && v(y, e) ? -1 : t === S || t.ownerDocument === y && v(y, t) ? 1 : l ? P(l, e) - P(l, t) : 0 : 4 & n ? -1 : 1)
                } : function(e, t) {
                    if (e === t) return c = !0, 0;
                    var n, i = 0,
                        o = e.parentNode,
                        r = t.parentNode,
                        s = [e],
                        a = [t];
                    if (!o || !r) return e === S ? -1 : t === S ? 1 : o ? -1 : r ? 1 : l ? P(l, e) - P(l, t) : 0;
                    if (o === r) return ue(e, t);
                    for (n = e; n = n.parentNode;) s.unshift(n);
                    for (n = t; n = n.parentNode;) a.unshift(n);
                    for (; s[i] === a[i];) i++;
                    return i ? ue(s[i], a[i]) : s[i] === y ? -1 : a[i] === y ? 1 : 0
                }), S
            }, re.matches = function(e, t) {
                return re(e, null, null, t)
            }, re.matchesSelector = function(e, t) {
                if ((e.ownerDocument || e) !== S && k(e), t = t.replace(U, "='$1']"), f.matchesSelector && T && !A[t + " "] && (!a || !a.test(t)) && (!m || !m.test(t))) try {
                    var n = u.call(e, t);
                    if (n || f.disconnectedMatch || e.document && 11 !== e.document.nodeType) return n
                } catch (e) {}
                return 0 < re(t, S, null, [e]).length
            }, re.contains = function(e, t) {
                return (e.ownerDocument || e) !== S && k(e), v(e, t)
            }, re.attr = function(e, t) {
                (e.ownerDocument || e) !== S && k(e);
                var n = w.attrHandle[t.toLowerCase()],
                    i = n && N.call(w.attrHandle, t.toLowerCase()) ? n(e, t, !T) : void 0;
                return void 0 !== i ? i : f.attributes || !T ? e.getAttribute(t) : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
            }, re.escape = function(e) {
                return (e + "").replace(te, ne)
            }, re.error = function(e) {
                throw new Error("Syntax error, unrecognized expression: " + e)
            }, re.uniqueSort = function(e) {
                var t, n = [],
                    i = 0,
                    o = 0;
                if (c = !f.detectDuplicates, l = !f.sortStable && e.slice(0), e.sort($), c) {
                    for (; t = e[o++];) t === e[o] && (i = n.push(o));
                    for (; i--;) e.splice(n[i], 1)
                }
                return l = null, e
            }, r = re.getText = function(e) {
                var t, n = "",
                    i = 0,
                    o = e.nodeType;
                if (o) {
                    if (1 === o || 9 === o || 11 === o) {
                        if ("string" == typeof e.textContent) return e.textContent;
                        for (e = e.firstChild; e; e = e.nextSibling) n += r(e)
                    } else if (3 === o || 4 === o) return e.nodeValue
                } else
                    for (; t = e[i++];) n += r(t);
                return n
            }, (w = re.selectors = {
                cacheLength: 50,
                createPseudo: ae,
                match: X,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: !0
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: !0
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function(e) {
                        return e[1] = e[1].replace(Z, ee), e[3] = (e[3] || e[4] || e[5] || "").replace(Z, ee), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                    },
                    CHILD: function(e) {
                        return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || re.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && re.error(e[0]), e
                    },
                    PSEUDO: function(e) {
                        var t, n = !e[6] && e[2];
                        return X.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && B.test(n) && (t = h(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function(e) {
                        var t = e.replace(Z, ee).toLowerCase();
                        return "*" === e ? function() {
                            return !0
                        } : function(e) {
                            return e.nodeName && e.nodeName.toLowerCase() === t
                        }
                    },
                    CLASS: function(e) {
                        var t = p[e + " "];
                        return t || (t = new RegExp("(^|" + M + ")" + e + "(" + M + "|$)")) && p(e, function(e) {
                            return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "")
                        })
                    },
                    ATTR: function(n, i, o) {
                        return function(e) {
                            var t = re.attr(e, n);
                            return null == t ? "!=" === i : !i || (t += "", "=" === i ? t === o : "!=" === i ? t !== o : "^=" === i ? o && 0 === t.indexOf(o) : "*=" === i ? o && -1 < t.indexOf(o) : "$=" === i ? o && t.slice(-o.length) === o : "~=" === i ? -1 < (" " + t.replace(_, " ") + " ").indexOf(o) : "|=" === i && (t === o || t.slice(0, o.length + 1) === o + "-"))
                        }
                    },
                    CHILD: function(h, e, t, g, m) {
                        var v = "nth" !== h.slice(0, 3),
                            y = "last" !== h.slice(-4),
                            b = "of-type" === e;
                        return 1 === g && 0 === m ? function(e) {
                            return !!e.parentNode
                        } : function(e, t, n) {
                            var i, o, r, s, a, l, c = v !== y ? "nextSibling" : "previousSibling",
                                u = e.parentNode,
                                d = b && e.nodeName.toLowerCase(),
                                p = !n && !b,
                                f = !1;
                            if (u) {
                                if (v) {
                                    for (; c;) {
                                        for (s = e; s = s[c];)
                                            if (b ? s.nodeName.toLowerCase() === d : 1 === s.nodeType) return !1;
                                        l = c = "only" === h && !l && "nextSibling"
                                    }
                                    return !0
                                }
                                if (l = [y ? u.firstChild : u.lastChild], y && p) {
                                    for (f = (a = (i = (o = (r = (s = u)[C] || (s[C] = {}))[s.uniqueID] || (r[s.uniqueID] = {}))[h] || [])[0] === E && i[1]) && i[2], s = a && u.childNodes[a]; s = ++a && s && s[c] || (f = a = 0) || l.pop();)
                                        if (1 === s.nodeType && ++f && s === e) {
                                            o[h] = [E, a, f];
                                            break
                                        }
                                } else if (p && (f = a = (i = (o = (r = (s = e)[C] || (s[C] = {}))[s.uniqueID] || (r[s.uniqueID] = {}))[h] || [])[0] === E && i[1]), !1 === f)
                                    for (;
                                        (s = ++a && s && s[c] || (f = a = 0) || l.pop()) && ((b ? s.nodeName.toLowerCase() !== d : 1 !== s.nodeType) || !++f || (p && ((o = (r = s[C] || (s[C] = {}))[s.uniqueID] || (r[s.uniqueID] = {}))[h] = [E, f]), s !== e)););
                                return (f -= m) === g || f % g == 0 && 0 <= f / g
                            }
                        }
                    },
                    PSEUDO: function(e, r) {
                        var t, s = w.pseudos[e] || w.setFilters[e.toLowerCase()] || re.error("unsupported pseudo: " + e);
                        return s[C] ? s(r) : 1 < s.length ? (t = [e, e, "", r], w.setFilters.hasOwnProperty(e.toLowerCase()) ? ae(function(e, t) {
                            for (var n, i = s(e, r), o = i.length; o--;) e[n = P(e, i[o])] = !(t[n] = i[o])
                        }) : function(e) {
                            return s(e, 0, t)
                        }) : s
                    }
                },
                pseudos: {
                    not: ae(function(e) {
                        var i = [],
                            o = [],
                            a = d(e.replace(z, "$1"));
                        return a[C] ? ae(function(e, t, n, i) {
                            for (var o, r = a(e, null, i, []), s = e.length; s--;)(o = r[s]) && (e[s] = !(t[s] = o))
                        }) : function(e, t, n) {
                            return i[0] = e, a(i, null, n, o), i[0] = null, !o.pop()
                        }
                    }),
                    has: ae(function(t) {
                        return function(e) {
                            return 0 < re(t, e).length
                        }
                    }),
                    contains: ae(function(t) {
                        return t = t.replace(Z, ee),
                            function(e) {
                                return -1 < (e.textContent || e.innerText || r(e)).indexOf(t)
                            }
                    }),
                    lang: ae(function(n) {
                        return V.test(n || "") || re.error("unsupported lang: " + n), n = n.replace(Z, ee).toLowerCase(),
                            function(e) {
                                var t;
                                do {
                                    if (t = T ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return (t = t.toLowerCase()) === n || 0 === t.indexOf(n + "-")
                                } while ((e = e.parentNode) && 1 === e.nodeType);
                                return !1
                            }
                    }),
                    target: function(e) {
                        var t = n.location && n.location.hash;
                        return t && t.slice(1) === e.id
                    },
                    root: function(e) {
                        return e === s
                    },
                    focus: function(e) {
                        return e === S.activeElement && (!S.hasFocus || S.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                    },
                    enabled: fe(!1),
                    disabled: fe(!0),
                    checked: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && !!e.checked || "option" === t && !!e.selected
                    },
                    selected: function(e) {
                        return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
                    },
                    empty: function(e) {
                        for (e = e.firstChild; e; e = e.nextSibling)
                            if (e.nodeType < 6) return !1;
                        return !0
                    },
                    parent: function(e) {
                        return !w.pseudos.empty(e)
                    },
                    header: function(e) {
                        return K.test(e.nodeName)
                    },
                    input: function(e) {
                        return Y.test(e.nodeName)
                    },
                    button: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && "button" === e.type || "button" === t
                    },
                    text: function(e) {
                        var t;
                        return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                    },
                    first: he(function() {
                        return [0]
                    }),
                    last: he(function(e, t) {
                        return [t - 1]
                    }),
                    eq: he(function(e, t, n) {
                        return [n < 0 ? n + t : n]
                    }),
                    even: he(function(e, t) {
                        for (var n = 0; n < t; n += 2) e.push(n);
                        return e
                    }),
                    odd: he(function(e, t) {
                        for (var n = 1; n < t; n += 2) e.push(n);
                        return e
                    }),
                    lt: he(function(e, t, n) {
                        for (var i = n < 0 ? n + t : n; 0 <= --i;) e.push(i);
                        return e
                    }),
                    gt: he(function(e, t, n) {
                        for (var i = n < 0 ? n + t : n; ++i < t;) e.push(i);
                        return e
                    })
                }
            }).pseudos.nth = w.pseudos.eq, {
                radio: !0,
                checkbox: !0,
                file: !0,
                password: !0,
                image: !0
            }) w.pseudos[e] = de(e);
        for (e in {
                submit: !0,
                reset: !0
            }) w.pseudos[e] = pe(e);

        function me() {}

        function ve(e) {
            for (var t = 0, n = e.length, i = ""; t < n; t++) i += e[t].value;
            return i
        }

        function ye(a, e, t) {
            var l = e.dir,
                c = e.next,
                u = c || l,
                d = t && "parentNode" === u,
                p = i++;
            return e.first ? function(e, t, n) {
                for (; e = e[l];)
                    if (1 === e.nodeType || d) return a(e, t, n);
                return !1
            } : function(e, t, n) {
                var i, o, r, s = [E, p];
                if (n) {
                    for (; e = e[l];)
                        if ((1 === e.nodeType || d) && a(e, t, n)) return !0
                } else
                    for (; e = e[l];)
                        if (1 === e.nodeType || d)
                            if (o = (r = e[C] || (e[C] = {}))[e.uniqueID] || (r[e.uniqueID] = {}), c && c === e.nodeName.toLowerCase()) e = e[l] || e;
                            else {
                                if ((i = o[u]) && i[0] === E && i[1] === p) return s[2] = i[2];
                                if ((o[u] = s)[2] = a(e, t, n)) return !0
                            } return !1
            }
        }

        function be(o) {
            return 1 < o.length ? function(e, t, n) {
                for (var i = o.length; i--;)
                    if (!o[i](e, t, n)) return !1;
                return !0
            } : o[0]
        }

        function we(e, t, n, i, o) {
            for (var r, s = [], a = 0, l = e.length, c = null != t; a < l; a++)(r = e[a]) && (n && !n(r, i, o) || (s.push(r), c && t.push(a)));
            return s
        }

        function xe(f, h, g, m, v, e) {
            return m && !m[C] && (m = xe(m)), v && !v[C] && (v = xe(v, e)), ae(function(e, t, n, i) {
                var o, r, s, a = [],
                    l = [],
                    c = t.length,
                    u = e || function(e, t, n) {
                        for (var i = 0, o = t.length; i < o; i++) re(e, t[i], n);
                        return n
                    }(h || "*", n.nodeType ? [n] : n, []),
                    d = !f || !e && h ? u : we(u, a, f, n, i),
                    p = g ? v || (e ? f : c || m) ? [] : t : d;
                if (g && g(d, p, n, i), m)
                    for (o = we(p, l), m(o, [], n, i), r = o.length; r--;)(s = o[r]) && (p[l[r]] = !(d[l[r]] = s));
                if (e) {
                    if (v || f) {
                        if (v) {
                            for (o = [], r = p.length; r--;)(s = p[r]) && o.push(d[r] = s);
                            v(null, p = [], o, i)
                        }
                        for (r = p.length; r--;)(s = p[r]) && -1 < (o = v ? P(e, s) : a[r]) && (e[o] = !(t[o] = s))
                    }
                } else p = we(p === t ? p.splice(c, p.length) : p), v ? v(null, t, p, i) : j.apply(t, p)
            })
        }

        function ke(e) {
            for (var o, t, n, i = e.length, r = w.relative[e[0].type], s = r || w.relative[" "], a = r ? 1 : 0, l = ye(function(e) {
                    return e === o
                }, s, !0), c = ye(function(e) {
                    return -1 < P(o, e)
                }, s, !0), u = [function(e, t, n) {
                    var i = !r && (n || t !== x) || ((o = t).nodeType ? l(e, t, n) : c(e, t, n));
                    return o = null, i
                }]; a < i; a++)
                if (t = w.relative[e[a].type]) u = [ye(be(u), t)];
                else {
                    if ((t = w.filter[e[a].type].apply(null, e[a].matches))[C]) {
                        for (n = ++a; n < i && !w.relative[e[n].type]; n++);
                        return xe(1 < a && be(u), 1 < a && ve(e.slice(0, a - 1).concat({
                            value: " " === e[a - 2].type ? "*" : ""
                        })).replace(z, "$1"), t, a < n && ke(e.slice(a, n)), n < i && ke(e = e.slice(n)), n < i && ve(e))
                    }
                    u.push(t)
                }
            return be(u)
        }
        return me.prototype = w.filters = w.pseudos, w.setFilters = new me, h = re.tokenize = function(e, t) {
            var n, i, o, r, s, a, l, c = b[e + " "];
            if (c) return t ? 0 : c.slice(0);
            for (s = e, a = [], l = w.preFilter; s;) {
                for (r in n && !(i = W.exec(s)) || (i && (s = s.slice(i[0].length) || s), a.push(o = [])), n = !1, (i = R.exec(s)) && (n = i.shift(), o.push({
                        value: n,
                        type: i[0].replace(z, " ")
                    }), s = s.slice(n.length)), w.filter) !(i = X[r].exec(s)) || l[r] && !(i = l[r](i)) || (n = i.shift(), o.push({
                    value: n,
                    type: r,
                    matches: i
                }), s = s.slice(n.length));
                if (!n) break
            }
            return t ? s.length : s ? re.error(e) : b(e, a).slice(0)
        }, d = re.compile = function(e, t) {
            var n, m, v, y, b, i, o = [],
                r = [],
                s = A[e + " "];
            if (!s) {
                for (t || (t = h(e)), n = t.length; n--;)(s = ke(t[n]))[C] ? o.push(s) : r.push(s);
                (s = A(e, (m = r, v = o, y = 0 < v.length, b = 0 < m.length, i = function(e, t, n, i, o) {
                    var r, s, a, l = 0,
                        c = "0",
                        u = e && [],
                        d = [],
                        p = x,
                        f = e || b && w.find.TAG("*", o),
                        h = E += null == p ? 1 : Math.random() || .1,
                        g = f.length;
                    for (o && (x = t === S || t || o); c !== g && null != (r = f[c]); c++) {
                        if (b && r) {
                            for (s = 0, t || r.ownerDocument === S || (k(r), n = !T); a = m[s++];)
                                if (a(r, t || S, n)) {
                                    i.push(r);
                                    break
                                }
                            o && (E = h)
                        }
                        y && ((r = !a && r) && l--, e && u.push(r))
                    }
                    if (l += c, y && c !== l) {
                        for (s = 0; a = v[s++];) a(u, d, t, n);
                        if (e) {
                            if (0 < l)
                                for (; c--;) u[c] || d[c] || (d[c] = O.call(i));
                            d = we(d)
                        }
                        j.apply(i, d), o && !e && 0 < d.length && 1 < l + v.length && re.uniqueSort(i)
                    }
                    return o && (E = h, x = p), u
                }, y ? ae(i) : i))).selector = e
            }
            return s
        }, g = re.select = function(e, t, n, i) {
            var o, r, s, a, l, c = "function" == typeof e && e,
                u = !i && h(e = c.selector || e);
            if (n = n || [], 1 === u.length) {
                if (2 < (r = u[0] = u[0].slice(0)).length && "ID" === (s = r[0]).type && 9 === t.nodeType && T && w.relative[r[1].type]) {
                    if (!(t = (w.find.ID(s.matches[0].replace(Z, ee), t) || [])[0])) return n;
                    c && (t = t.parentNode), e = e.slice(r.shift().value.length)
                }
                for (o = X.needsContext.test(e) ? 0 : r.length; o-- && (s = r[o], !w.relative[a = s.type]);)
                    if ((l = w.find[a]) && (i = l(s.matches[0].replace(Z, ee), J.test(r[0].type) && ge(t.parentNode) || t))) {
                        if (r.splice(o, 1), !(e = i.length && ve(r))) return j.apply(n, i), n;
                        break
                    }
            }
            return (c || d(e, u))(i, t, !T, n, !t || J.test(e) && ge(t.parentNode) || t), n
        }, f.sortStable = C.split("").sort($).join("") === C, f.detectDuplicates = !!c, k(), f.sortDetached = le(function(e) {
            return 1 & e.compareDocumentPosition(S.createElement("fieldset"))
        }), le(function(e) {
            return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
        }) || ce("type|href|height|width", function(e, t, n) {
            if (!n) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
        }), f.attributes && le(function(e) {
            return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
        }) || ce("value", function(e, t, n) {
            if (!n && "input" === e.nodeName.toLowerCase()) return e.defaultValue
        }), le(function(e) {
            return null == e.getAttribute("disabled")
        }) || ce(H, function(e, t, n) {
            var i;
            if (!n) return !0 === e[t] ? t.toLowerCase() : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
        }), re
    }(S);
    C.find = f, C.expr = f.selectors, C.expr[":"] = C.expr.pseudos, C.uniqueSort = C.unique = f.uniqueSort, C.text = f.getText, C.isXMLDoc = f.isXML, C.contains = f.contains, C.escapeSelector = f.escape;
    var h = function(e, t, n) {
            for (var i = [], o = void 0 !== n;
                (e = e[t]) && 9 !== e.nodeType;)
                if (1 === e.nodeType) {
                    if (o && C(e).is(n)) break;
                    i.push(e)
                }
            return i
        },
        k = function(e, t) {
            for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
            return n
        },
        E = C.expr.match.needsContext;

    function A(e, t) {
        return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
    }
    var $ = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;

    function N(e, n, i) {
        return y(n) ? C.grep(e, function(e, t) {
            return !!n.call(e, t, e) !== i
        }) : n.nodeType ? C.grep(e, function(e) {
            return e === n !== i
        }) : "string" != typeof n ? C.grep(e, function(e) {
            return -1 < o.call(n, e) !== i
        }) : C.filter(n, e, i)
    }
    C.filter = function(e, t, n) {
        var i = t[0];
        return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === i.nodeType ? C.find.matchesSelector(i, e) ? [i] : [] : C.find.matches(e, C.grep(t, function(e) {
            return 1 === e.nodeType
        }))
    }, C.fn.extend({
        find: function(e) {
            var t, n, i = this.length,
                o = this;
            if ("string" != typeof e) return this.pushStack(C(e).filter(function() {
                for (t = 0; t < i; t++)
                    if (C.contains(o[t], this)) return !0
            }));
            for (n = this.pushStack([]), t = 0; t < i; t++) C.find(e, o[t], n);
            return 1 < i ? C.uniqueSort(n) : n
        },
        filter: function(e) {
            return this.pushStack(N(this, e || [], !1))
        },
        not: function(e) {
            return this.pushStack(N(this, e || [], !0))
        },
        is: function(e) {
            return !!N(this, "string" == typeof e && E.test(e) ? C(e) : e || [], !1).length
        }
    });
    var O, D = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
    (C.fn.init = function(e, t, n) {
        var i, o;
        if (!e) return this;
        if (n = n || O, "string" == typeof e) {
            if (!(i = "<" === e[0] && ">" === e[e.length - 1] && 3 <= e.length ? [null, e, null] : D.exec(e)) || !i[1] && t) return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
            if (i[1]) {
                if (t = t instanceof C ? t[0] : t, C.merge(this, C.parseHTML(i[1], t && t.nodeType ? t.ownerDocument || t : T, !0)), $.test(i[1]) && C.isPlainObject(t))
                    for (i in t) y(this[i]) ? this[i](t[i]) : this.attr(i, t[i]);
                return this
            }
            return (o = T.getElementById(i[2])) && (this[0] = o, this.length = 1), this
        }
        return e.nodeType ? (this[0] = e, this.length = 1, this) : y(e) ? void 0 !== n.ready ? n.ready(e) : e(C) : C.makeArray(e, this)
    }).prototype = C.fn, O = C(T);
    var j = /^(?:parents|prev(?:Until|All))/,
        L = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };

    function P(e, t) {
        for (;
            (e = e[t]) && 1 !== e.nodeType;);
        return e
    }
    C.fn.extend({
        has: function(e) {
            var t = C(e, this),
                n = t.length;
            return this.filter(function() {
                for (var e = 0; e < n; e++)
                    if (C.contains(this, t[e])) return !0
            })
        },
        closest: function(e, t) {
            var n, i = 0,
                o = this.length,
                r = [],
                s = "string" != typeof e && C(e);
            if (!E.test(e))
                for (; i < o; i++)
                    for (n = this[i]; n && n !== t; n = n.parentNode)
                        if (n.nodeType < 11 && (s ? -1 < s.index(n) : 1 === n.nodeType && C.find.matchesSelector(n, e))) {
                            r.push(n);
                            break
                        }
            return this.pushStack(1 < r.length ? C.uniqueSort(r) : r)
        },
        index: function(e) {
            return e ? "string" == typeof e ? o.call(C(e), this[0]) : o.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function(e, t) {
            return this.pushStack(C.uniqueSort(C.merge(this.get(), C(e, t))))
        },
        addBack: function(e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    }), C.each({
        parent: function(e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        },
        parents: function(e) {
            return h(e, "parentNode")
        },
        parentsUntil: function(e, t, n) {
            return h(e, "parentNode", n)
        },
        next: function(e) {
            return P(e, "nextSibling")
        },
        prev: function(e) {
            return P(e, "previousSibling")
        },
        nextAll: function(e) {
            return h(e, "nextSibling")
        },
        prevAll: function(e) {
            return h(e, "previousSibling")
        },
        nextUntil: function(e, t, n) {
            return h(e, "nextSibling", n)
        },
        prevUntil: function(e, t, n) {
            return h(e, "previousSibling", n)
        },
        siblings: function(e) {
            return k((e.parentNode || {}).firstChild, e)
        },
        children: function(e) {
            return k(e.firstChild)
        },
        contents: function(e) {
            return A(e, "iframe") ? e.contentDocument : (A(e, "template") && (e = e.content || e), C.merge([], e.childNodes))
        }
    }, function(i, o) {
        C.fn[i] = function(e, t) {
            var n = C.map(this, o, e);
            return "Until" !== i.slice(-5) && (t = e), t && "string" == typeof t && (n = C.filter(t, n)), 1 < this.length && (L[i] || C.uniqueSort(n), j.test(i) && n.reverse()), this.pushStack(n)
        }
    });
    var H = /[^\x20\t\r\n\f]+/g;

    function M(e) {
        return e
    }

    function q(e) {
        throw e
    }

    function I(e, t, n, i) {
        var o;
        try {
            e && y(o = e.promise) ? o.call(e).done(t).fail(n) : e && y(o = e.then) ? o.call(e, t, n) : t.apply(void 0, [e].slice(i))
        } catch (e) {
            n.apply(void 0, [e])
        }
    }
    C.Callbacks = function(i) {
        var e, n;
        i = "string" == typeof i ? (e = i, n = {}, C.each(e.match(H) || [], function(e, t) {
            n[t] = !0
        }), n) : C.extend({}, i);
        var o, t, r, s, a = [],
            l = [],
            c = -1,
            u = function() {
                for (s = s || i.once, r = o = !0; l.length; c = -1)
                    for (t = l.shift(); ++c < a.length;) !1 === a[c].apply(t[0], t[1]) && i.stopOnFalse && (c = a.length, t = !1);
                i.memory || (t = !1), o = !1, s && (a = t ? [] : "")
            },
            d = {
                add: function() {
                    return a && (t && !o && (c = a.length - 1, l.push(t)), function n(e) {
                        C.each(e, function(e, t) {
                            y(t) ? i.unique && d.has(t) || a.push(t) : t && t.length && "string" !== x(t) && n(t)
                        })
                    }(arguments), t && !o && u()), this
                },
                remove: function() {
                    return C.each(arguments, function(e, t) {
                        for (var n; - 1 < (n = C.inArray(t, a, n));) a.splice(n, 1), n <= c && c--
                    }), this
                },
                has: function(e) {
                    return e ? -1 < C.inArray(e, a) : 0 < a.length
                },
                empty: function() {
                    return a && (a = []), this
                },
                disable: function() {
                    return s = l = [], a = t = "", this
                },
                disabled: function() {
                    return !a
                },
                lock: function() {
                    return s = l = [], t || o || (a = t = ""), this
                },
                locked: function() {
                    return !!s
                },
                fireWith: function(e, t) {
                    return s || (t = [e, (t = t || []).slice ? t.slice() : t], l.push(t), o || u()), this
                },
                fire: function() {
                    return d.fireWith(this, arguments), this
                },
                fired: function() {
                    return !!r
                }
            };
        return d
    }, C.extend({
        Deferred: function(e) {
            var r = [
                    ["notify", "progress", C.Callbacks("memory"), C.Callbacks("memory"), 2],
                    ["resolve", "done", C.Callbacks("once memory"), C.Callbacks("once memory"), 0, "resolved"],
                    ["reject", "fail", C.Callbacks("once memory"), C.Callbacks("once memory"), 1, "rejected"]
                ],
                o = "pending",
                s = {
                    state: function() {
                        return o
                    },
                    always: function() {
                        return a.done(arguments).fail(arguments), this
                    },
                    catch: function(e) {
                        return s.then(null, e)
                    },
                    pipe: function() {
                        var o = arguments;
                        return C.Deferred(function(i) {
                            C.each(r, function(e, t) {
                                var n = y(o[t[4]]) && o[t[4]];
                                a[t[1]](function() {
                                    var e = n && n.apply(this, arguments);
                                    e && y(e.promise) ? e.promise().progress(i.notify).done(i.resolve).fail(i.reject) : i[t[0] + "With"](this, n ? [e] : arguments)
                                })
                            }), o = null
                        }).promise()
                    },
                    then: function(t, n, i) {
                        var l = 0;

                        function c(o, r, s, a) {
                            return function() {
                                var n = this,
                                    i = arguments,
                                    e = function() {
                                        var e, t;
                                        if (!(o < l)) {
                                            if ((e = s.apply(n, i)) === r.promise()) throw new TypeError("Thenable self-resolution");
                                            t = e && ("object" == typeof e || "function" == typeof e) && e.then, y(t) ? a ? t.call(e, c(l, r, M, a), c(l, r, q, a)) : (l++, t.call(e, c(l, r, M, a), c(l, r, q, a), c(l, r, M, r.notifyWith))) : (s !== M && (n = void 0, i = [e]), (a || r.resolveWith)(n, i))
                                        }
                                    },
                                    t = a ? e : function() {
                                        try {
                                            e()
                                        } catch (e) {
                                            C.Deferred.exceptionHook && C.Deferred.exceptionHook(e, t.stackTrace), l <= o + 1 && (s !== q && (n = void 0, i = [e]), r.rejectWith(n, i))
                                        }
                                    };
                                o ? t() : (C.Deferred.getStackHook && (t.stackTrace = C.Deferred.getStackHook()), S.setTimeout(t))
                            }
                        }
                        return C.Deferred(function(e) {
                            r[0][3].add(c(0, e, y(i) ? i : M, e.notifyWith)), r[1][3].add(c(0, e, y(t) ? t : M)), r[2][3].add(c(0, e, y(n) ? n : q))
                        }).promise()
                    },
                    promise: function(e) {
                        return null != e ? C.extend(e, s) : s
                    }
                },
                a = {};
            return C.each(r, function(e, t) {
                var n = t[2],
                    i = t[5];
                s[t[1]] = n.add, i && n.add(function() {
                    o = i
                }, r[3 - e][2].disable, r[3 - e][3].disable, r[0][2].lock, r[0][3].lock), n.add(t[3].fire), a[t[0]] = function() {
                    return a[t[0] + "With"](this === a ? void 0 : this, arguments), this
                }, a[t[0] + "With"] = n.fireWith
            }), s.promise(a), e && e.call(a, a), a
        },
        when: function(e) {
            var n = arguments.length,
                t = n,
                i = Array(t),
                o = a.call(arguments),
                r = C.Deferred(),
                s = function(t) {
                    return function(e) {
                        i[t] = this, o[t] = 1 < arguments.length ? a.call(arguments) : e, --n || r.resolveWith(i, o)
                    }
                };
            if (n <= 1 && (I(e, r.done(s(t)).resolve, r.reject, !n), "pending" === r.state() || y(o[t] && o[t].then))) return r.then();
            for (; t--;) I(o[t], s(t), r.reject);
            return r.promise()
        }
    });
    var F = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
    C.Deferred.exceptionHook = function(e, t) {
        S.console && S.console.warn && e && F.test(e.name) && S.console.warn("jQuery.Deferred exception: " + e.message, e.stack, t)
    }, C.readyException = function(e) {
        S.setTimeout(function() {
            throw e
        })
    };
    var _ = C.Deferred();

    function z() {
        T.removeEventListener("DOMContentLoaded", z), S.removeEventListener("load", z), C.ready()
    }
    C.fn.ready = function(e) {
        return _.then(e).catch(function(e) {
            C.readyException(e)
        }), this
    }, C.extend({
        isReady: !1,
        readyWait: 1,
        ready: function(e) {
            (!0 === e ? --C.readyWait : C.isReady) || ((C.isReady = !0) !== e && 0 < --C.readyWait || _.resolveWith(T, [C]))
        }
    }), C.ready.then = _.then, "complete" === T.readyState || "loading" !== T.readyState && !T.documentElement.doScroll ? S.setTimeout(C.ready) : (T.addEventListener("DOMContentLoaded", z), S.addEventListener("load", z));
    var W = function(e, t, n, i, o, r, s) {
            var a = 0,
                l = e.length,
                c = null == n;
            if ("object" === x(n))
                for (a in o = !0, n) W(e, t, a, n[a], !0, r, s);
            else if (void 0 !== i && (o = !0, y(i) || (s = !0), c && (s ? (t.call(e, i), t = null) : (c = t, t = function(e, t, n) {
                    return c.call(C(e), n)
                })), t))
                for (; a < l; a++) t(e[a], n, s ? i : i.call(e[a], a, t(e[a], n)));
            return o ? e : c ? t.call(e) : l ? t(e[0], n) : r
        },
        R = /^-ms-/,
        U = /-([a-z])/g;

    function B(e, t) {
        return t.toUpperCase()
    }

    function V(e) {
        return e.replace(R, "ms-").replace(U, B)
    }
    var X = function(e) {
        return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
    };

    function Y() {
        this.expando = C.expando + Y.uid++
    }
    Y.uid = 1, Y.prototype = {
        cache: function(e) {
            var t = e[this.expando];
            return t || (t = {}, X(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
                value: t,
                configurable: !0
            }))), t
        },
        set: function(e, t, n) {
            var i, o = this.cache(e);
            if ("string" == typeof t) o[V(t)] = n;
            else
                for (i in t) o[V(i)] = t[i];
            return o
        },
        get: function(e, t) {
            return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][V(t)]
        },
        access: function(e, t, n) {
            return void 0 === t || t && "string" == typeof t && void 0 === n ? this.get(e, t) : (this.set(e, t, n), void 0 !== n ? n : t)
        },
        remove: function(e, t) {
            var n, i = e[this.expando];
            if (void 0 !== i) {
                if (void 0 !== t) {
                    n = (t = Array.isArray(t) ? t.map(V) : (t = V(t)) in i ? [t] : t.match(H) || []).length;
                    for (; n--;) delete i[t[n]]
                }(void 0 === t || C.isEmptyObject(i)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando])
            }
        },
        hasData: function(e) {
            var t = e[this.expando];
            return void 0 !== t && !C.isEmptyObject(t)
        }
    };
    var K = new Y,
        Q = new Y,
        G = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        J = /[A-Z]/g;

    function Z(e, t, n) {
        var i, o;
        if (void 0 === n && 1 === e.nodeType)
            if (i = "data-" + t.replace(J, "-$&").toLowerCase(), "string" == typeof(n = e.getAttribute(i))) {
                try {
                    n = "true" === (o = n) || "false" !== o && ("null" === o ? null : o === +o + "" ? +o : G.test(o) ? JSON.parse(o) : o)
                } catch (e) {}
                Q.set(e, t, n)
            } else n = void 0;
        return n
    }
    C.extend({
        hasData: function(e) {
            return Q.hasData(e) || K.hasData(e)
        },
        data: function(e, t, n) {
            return Q.access(e, t, n)
        },
        removeData: function(e, t) {
            Q.remove(e, t)
        },
        _data: function(e, t, n) {
            return K.access(e, t, n)
        },
        _removeData: function(e, t) {
            K.remove(e, t)
        }
    }), C.fn.extend({
        data: function(n, e) {
            var t, i, o, r = this[0],
                s = r && r.attributes;
            if (void 0 === n) {
                if (this.length && (o = Q.get(r), 1 === r.nodeType && !K.get(r, "hasDataAttrs"))) {
                    for (t = s.length; t--;) s[t] && 0 === (i = s[t].name).indexOf("data-") && (i = V(i.slice(5)), Z(r, i, o[i]));
                    K.set(r, "hasDataAttrs", !0)
                }
                return o
            }
            return "object" == typeof n ? this.each(function() {
                Q.set(this, n)
            }) : W(this, function(e) {
                var t;
                if (r && void 0 === e) {
                    if (void 0 !== (t = Q.get(r, n))) return t;
                    if (void 0 !== (t = Z(r, n))) return t
                } else this.each(function() {
                    Q.set(this, n, e)
                })
            }, null, e, 1 < arguments.length, null, !0)
        },
        removeData: function(e) {
            return this.each(function() {
                Q.remove(this, e)
            })
        }
    }), C.extend({
        queue: function(e, t, n) {
            var i;
            if (e) return t = (t || "fx") + "queue", i = K.get(e, t), n && (!i || Array.isArray(n) ? i = K.access(e, t, C.makeArray(n)) : i.push(n)), i || []
        },
        dequeue: function(e, t) {
            t = t || "fx";
            var n = C.queue(e, t),
                i = n.length,
                o = n.shift(),
                r = C._queueHooks(e, t);
            "inprogress" === o && (o = n.shift(), i--), o && ("fx" === t && n.unshift("inprogress"), delete r.stop, o.call(e, function() {
                C.dequeue(e, t)
            }, r)), !i && r && r.empty.fire()
        },
        _queueHooks: function(e, t) {
            var n = t + "queueHooks";
            return K.get(e, n) || K.access(e, n, {
                empty: C.Callbacks("once memory").add(function() {
                    K.remove(e, [t + "queue", n])
                })
            })
        }
    }), C.fn.extend({
        queue: function(t, n) {
            var e = 2;
            return "string" != typeof t && (n = t, t = "fx", e--), arguments.length < e ? C.queue(this[0], t) : void 0 === n ? this : this.each(function() {
                var e = C.queue(this, t, n);
                C._queueHooks(this, t), "fx" === t && "inprogress" !== e[0] && C.dequeue(this, t)
            })
        },
        dequeue: function(e) {
            return this.each(function() {
                C.dequeue(this, e)
            })
        },
        clearQueue: function(e) {
            return this.queue(e || "fx", [])
        },
        promise: function(e, t) {
            var n, i = 1,
                o = C.Deferred(),
                r = this,
                s = this.length,
                a = function() {
                    --i || o.resolveWith(r, [r])
                };
            for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; s--;)(n = K.get(r[s], e + "queueHooks")) && n.empty && (i++, n.empty.add(a));
            return a(), o.promise(t)
        }
    });
    var ee = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        te = new RegExp("^(?:([+-])=|)(" + ee + ")([a-z%]*)$", "i"),
        ne = ["Top", "Right", "Bottom", "Left"],
        ie = function(e, t) {
            return "none" === (e = t || e).style.display || "" === e.style.display && C.contains(e.ownerDocument, e) && "none" === C.css(e, "display")
        },
        oe = function(e, t, n, i) {
            var o, r, s = {};
            for (r in t) s[r] = e.style[r], e.style[r] = t[r];
            for (r in o = n.apply(e, i || []), t) e.style[r] = s[r];
            return o
        };

    function re(e, t, n, i) {
        var o, r, s = 20,
            a = i ? function() {
                return i.cur()
            } : function() {
                return C.css(e, t, "")
            },
            l = a(),
            c = n && n[3] || (C.cssNumber[t] ? "" : "px"),
            u = (C.cssNumber[t] || "px" !== c && +l) && te.exec(C.css(e, t));
        if (u && u[3] !== c) {
            for (l /= 2, c = c || u[3], u = +l || 1; s--;) C.style(e, t, u + c), (1 - r) * (1 - (r = a() / l || .5)) <= 0 && (s = 0), u /= r;
            u *= 2, C.style(e, t, u + c), n = n || []
        }
        return n && (u = +u || +l || 0, o = n[1] ? u + (n[1] + 1) * n[2] : +n[2], i && (i.unit = c, i.start = u, i.end = o)), o
    }
    var se = {};

    function ae(e, t) {
        for (var n, i, o = [], r = 0, s = e.length; r < s; r++)(i = e[r]).style && (n = i.style.display, t ? ("none" === n && (o[r] = K.get(i, "display") || null, o[r] || (i.style.display = "")), "" === i.style.display && ie(i) && (o[r] = (d = c = l = void 0, c = (a = i).ownerDocument, u = a.nodeName, (d = se[u]) || (l = c.body.appendChild(c.createElement(u)), d = C.css(l, "display"), l.parentNode.removeChild(l), "none" === d && (d = "block"), se[u] = d)))) : "none" !== n && (o[r] = "none", K.set(i, "display", n)));
        var a, l, c, u, d;
        for (r = 0; r < s; r++) null != o[r] && (e[r].style.display = o[r]);
        return e
    }
    C.fn.extend({
        show: function() {
            return ae(this, !0)
        },
        hide: function() {
            return ae(this)
        },
        toggle: function(e) {
            return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function() {
                ie(this) ? C(this).show() : C(this).hide()
            })
        }
    });
    var le = /^(?:checkbox|radio)$/i,
        ce = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i,
        ue = /^$|^module$|\/(?:java|ecma)script/i,
        de = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            thead: [1, "<table>", "</table>"],
            col: [2, "<table><colgroup>", "</colgroup></table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: [0, "", ""]
        };

    function pe(e, t) {
        var n;
        return n = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && A(e, t) ? C.merge([e], n) : n
    }

    function fe(e, t) {
        for (var n = 0, i = e.length; n < i; n++) K.set(e[n], "globalEval", !t || K.get(t[n], "globalEval"))
    }
    de.optgroup = de.option, de.tbody = de.tfoot = de.colgroup = de.caption = de.thead, de.th = de.td;
    var he, ge, me = /<|&#?\w+;/;

    function ve(e, t, n, i, o) {
        for (var r, s, a, l, c, u, d = t.createDocumentFragment(), p = [], f = 0, h = e.length; f < h; f++)
            if ((r = e[f]) || 0 === r)
                if ("object" === x(r)) C.merge(p, r.nodeType ? [r] : r);
                else if (me.test(r)) {
            for (s = s || d.appendChild(t.createElement("div")), a = (ce.exec(r) || ["", ""])[1].toLowerCase(), l = de[a] || de._default, s.innerHTML = l[1] + C.htmlPrefilter(r) + l[2], u = l[0]; u--;) s = s.lastChild;
            C.merge(p, s.childNodes), (s = d.firstChild).textContent = ""
        } else p.push(t.createTextNode(r));
        for (d.textContent = "", f = 0; r = p[f++];)
            if (i && -1 < C.inArray(r, i)) o && o.push(r);
            else if (c = C.contains(r.ownerDocument, r), s = pe(d.appendChild(r), "script"), c && fe(s), n)
            for (u = 0; r = s[u++];) ue.test(r.type || "") && n.push(r);
        return d
    }
    he = T.createDocumentFragment().appendChild(T.createElement("div")), (ge = T.createElement("input")).setAttribute("type", "radio"), ge.setAttribute("checked", "checked"), ge.setAttribute("name", "t"), he.appendChild(ge), v.checkClone = he.cloneNode(!0).cloneNode(!0).lastChild.checked, he.innerHTML = "<textarea>x</textarea>", v.noCloneChecked = !!he.cloneNode(!0).lastChild.defaultValue;
    var ye = T.documentElement,
        be = /^key/,
        we = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
        xe = /^([^.]*)(?:\.(.+)|)/;

    function ke() {
        return !0
    }

    function Se() {
        return !1
    }

    function Te() {
        try {
            return T.activeElement
        } catch (e) {}
    }

    function Ce(e, t, n, i, o, r) {
        var s, a;
        if ("object" == typeof t) {
            for (a in "string" != typeof n && (i = i || n, n = void 0), t) Ce(e, a, n, i, t[a], r);
            return e
        }
        if (null == i && null == o ? (o = n, i = n = void 0) : null == o && ("string" == typeof n ? (o = i, i = void 0) : (o = i, i = n, n = void 0)), !1 === o) o = Se;
        else if (!o) return e;
        return 1 === r && (s = o, (o = function(e) {
            return C().off(e), s.apply(this, arguments)
        }).guid = s.guid || (s.guid = C.guid++)), e.each(function() {
            C.event.add(this, t, o, i, n)
        })
    }
    C.event = {
        global: {},
        add: function(t, e, n, i, o) {
            var r, s, a, l, c, u, d, p, f, h, g, m = K.get(t);
            if (m)
                for (n.handler && (n = (r = n).handler, o = r.selector), o && C.find.matchesSelector(ye, o), n.guid || (n.guid = C.guid++), (l = m.events) || (l = m.events = {}), (s = m.handle) || (s = m.handle = function(e) {
                        return void 0 !== C && C.event.triggered !== e.type ? C.event.dispatch.apply(t, arguments) : void 0
                    }), c = (e = (e || "").match(H) || [""]).length; c--;) f = g = (a = xe.exec(e[c]) || [])[1], h = (a[2] || "").split(".").sort(), f && (d = C.event.special[f] || {}, f = (o ? d.delegateType : d.bindType) || f, d = C.event.special[f] || {}, u = C.extend({
                    type: f,
                    origType: g,
                    data: i,
                    handler: n,
                    guid: n.guid,
                    selector: o,
                    needsContext: o && C.expr.match.needsContext.test(o),
                    namespace: h.join(".")
                }, r), (p = l[f]) || ((p = l[f] = []).delegateCount = 0, d.setup && !1 !== d.setup.call(t, i, h, s) || t.addEventListener && t.addEventListener(f, s)), d.add && (d.add.call(t, u), u.handler.guid || (u.handler.guid = n.guid)), o ? p.splice(p.delegateCount++, 0, u) : p.push(u), C.event.global[f] = !0)
        },
        remove: function(e, t, n, i, o) {
            var r, s, a, l, c, u, d, p, f, h, g, m = K.hasData(e) && K.get(e);
            if (m && (l = m.events)) {
                for (c = (t = (t || "").match(H) || [""]).length; c--;)
                    if (f = g = (a = xe.exec(t[c]) || [])[1], h = (a[2] || "").split(".").sort(), f) {
                        for (d = C.event.special[f] || {}, p = l[f = (i ? d.delegateType : d.bindType) || f] || [], a = a[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), s = r = p.length; r--;) u = p[r], !o && g !== u.origType || n && n.guid !== u.guid || a && !a.test(u.namespace) || i && i !== u.selector && ("**" !== i || !u.selector) || (p.splice(r, 1), u.selector && p.delegateCount--, d.remove && d.remove.call(e, u));
                        s && !p.length && (d.teardown && !1 !== d.teardown.call(e, h, m.handle) || C.removeEvent(e, f, m.handle), delete l[f])
                    } else
                        for (f in l) C.event.remove(e, f + t[c], n, i, !0);
                C.isEmptyObject(l) && K.remove(e, "handle events")
            }
        },
        dispatch: function(e) {
            var t, n, i, o, r, s, a = C.event.fix(e),
                l = new Array(arguments.length),
                c = (K.get(this, "events") || {})[a.type] || [],
                u = C.event.special[a.type] || {};
            for (l[0] = a, t = 1; t < arguments.length; t++) l[t] = arguments[t];
            if (a.delegateTarget = this, !u.preDispatch || !1 !== u.preDispatch.call(this, a)) {
                for (s = C.event.handlers.call(this, a, c), t = 0;
                    (o = s[t++]) && !a.isPropagationStopped();)
                    for (a.currentTarget = o.elem, n = 0;
                        (r = o.handlers[n++]) && !a.isImmediatePropagationStopped();) a.rnamespace && !a.rnamespace.test(r.namespace) || (a.handleObj = r, a.data = r.data, void 0 !== (i = ((C.event.special[r.origType] || {}).handle || r.handler).apply(o.elem, l)) && !1 === (a.result = i) && (a.preventDefault(), a.stopPropagation()));
                return u.postDispatch && u.postDispatch.call(this, a), a.result
            }
        },
        handlers: function(e, t) {
            var n, i, o, r, s, a = [],
                l = t.delegateCount,
                c = e.target;
            if (l && c.nodeType && !("click" === e.type && 1 <= e.button))
                for (; c !== this; c = c.parentNode || this)
                    if (1 === c.nodeType && ("click" !== e.type || !0 !== c.disabled)) {
                        for (r = [], s = {}, n = 0; n < l; n++) void 0 === s[o = (i = t[n]).selector + " "] && (s[o] = i.needsContext ? -1 < C(o, this).index(c) : C.find(o, this, null, [c]).length), s[o] && r.push(i);
                        r.length && a.push({
                            elem: c,
                            handlers: r
                        })
                    }
            return c = this, l < t.length && a.push({
                elem: c,
                handlers: t.slice(l)
            }), a
        },
        addProp: function(t, e) {
            Object.defineProperty(C.Event.prototype, t, {
                enumerable: !0,
                configurable: !0,
                get: y(e) ? function() {
                    if (this.originalEvent) return e(this.originalEvent)
                } : function() {
                    if (this.originalEvent) return this.originalEvent[t]
                },
                set: function(e) {
                    Object.defineProperty(this, t, {
                        enumerable: !0,
                        configurable: !0,
                        writable: !0,
                        value: e
                    })
                }
            })
        },
        fix: function(e) {
            return e[C.expando] ? e : new C.Event(e)
        },
        special: {
            load: {
                noBubble: !0
            },
            focus: {
                trigger: function() {
                    if (this !== Te() && this.focus) return this.focus(), !1
                },
                delegateType: "focusin"
            },
            blur: {
                trigger: function() {
                    if (this === Te() && this.blur) return this.blur(), !1
                },
                delegateType: "focusout"
            },
            click: {
                trigger: function() {
                    if ("checkbox" === this.type && this.click && A(this, "input")) return this.click(), !1
                },
                _default: function(e) {
                    return A(e.target, "a")
                }
            },
            beforeunload: {
                postDispatch: function(e) {
                    void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                }
            }
        }
    }, C.removeEvent = function(e, t, n) {
        e.removeEventListener && e.removeEventListener(t, n)
    }, C.Event = function(e, t) {
        if (!(this instanceof C.Event)) return new C.Event(e, t);
        e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? ke : Se, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && C.extend(this, t), this.timeStamp = e && e.timeStamp || Date.now(), this[C.expando] = !0
    }, C.Event.prototype = {
        constructor: C.Event,
        isDefaultPrevented: Se,
        isPropagationStopped: Se,
        isImmediatePropagationStopped: Se,
        isSimulated: !1,
        preventDefault: function() {
            var e = this.originalEvent;
            this.isDefaultPrevented = ke, e && !this.isSimulated && e.preventDefault()
        },
        stopPropagation: function() {
            var e = this.originalEvent;
            this.isPropagationStopped = ke, e && !this.isSimulated && e.stopPropagation()
        },
        stopImmediatePropagation: function() {
            var e = this.originalEvent;
            this.isImmediatePropagationStopped = ke, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation()
        }
    }, C.each({
        altKey: !0,
        bubbles: !0,
        cancelable: !0,
        changedTouches: !0,
        ctrlKey: !0,
        detail: !0,
        eventPhase: !0,
        metaKey: !0,
        pageX: !0,
        pageY: !0,
        shiftKey: !0,
        view: !0,
        char: !0,
        charCode: !0,
        key: !0,
        keyCode: !0,
        button: !0,
        buttons: !0,
        clientX: !0,
        clientY: !0,
        offsetX: !0,
        offsetY: !0,
        pointerId: !0,
        pointerType: !0,
        screenX: !0,
        screenY: !0,
        targetTouches: !0,
        toElement: !0,
        touches: !0,
        which: function(e) {
            var t = e.button;
            return null == e.which && be.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && we.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which
        }
    }, C.event.addProp), C.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function(e, o) {
        C.event.special[e] = {
            delegateType: o,
            bindType: o,
            handle: function(e) {
                var t, n = e.relatedTarget,
                    i = e.handleObj;
                return n && (n === this || C.contains(this, n)) || (e.type = i.origType, t = i.handler.apply(this, arguments), e.type = o), t
            }
        }
    }), C.fn.extend({
        on: function(e, t, n, i) {
            return Ce(this, e, t, n, i)
        },
        one: function(e, t, n, i) {
            return Ce(this, e, t, n, i, 1)
        },
        off: function(e, t, n) {
            var i, o;
            if (e && e.preventDefault && e.handleObj) return i = e.handleObj, C(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
            if ("object" == typeof e) {
                for (o in e) this.off(o, t, e[o]);
                return this
            }
            return !1 !== t && "function" != typeof t || (n = t, t = void 0), !1 === n && (n = Se), this.each(function() {
                C.event.remove(this, e, n, t)
            })
        }
    });
    var Ee = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
        Ae = /<script|<style|<link/i,
        $e = /checked\s*(?:[^=]|=\s*.checked.)/i,
        Ne = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

    function Oe(e, t) {
        return A(e, "table") && A(11 !== t.nodeType ? t : t.firstChild, "tr") && C(e).children("tbody")[0] || e
    }

    function De(e) {
        return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
    }

    function je(e) {
        return "true/" === (e.type || "").slice(0, 5) ? e.type = e.type.slice(5) : e.removeAttribute("type"), e
    }

    function Le(e, t) {
        var n, i, o, r, s, a, l, c;
        if (1 === t.nodeType) {
            if (K.hasData(e) && (r = K.access(e), s = K.set(t, r), c = r.events))
                for (o in delete s.handle, s.events = {}, c)
                    for (n = 0, i = c[o].length; n < i; n++) C.event.add(t, o, c[o][n]);
            Q.hasData(e) && (a = Q.access(e), l = C.extend({}, a), Q.set(t, l))
        }
    }

    function Pe(n, i, o, r) {
        i = g.apply([], i);
        var e, t, s, a, l, c, u = 0,
            d = n.length,
            p = d - 1,
            f = i[0],
            h = y(f);
        if (h || 1 < d && "string" == typeof f && !v.checkClone && $e.test(f)) return n.each(function(e) {
            var t = n.eq(e);
            h && (i[0] = f.call(this, e, t.html())), Pe(t, i, o, r)
        });
        if (d && (t = (e = ve(i, n[0].ownerDocument, !1, n, r)).firstChild, 1 === e.childNodes.length && (e = t), t || r)) {
            for (a = (s = C.map(pe(e, "script"), De)).length; u < d; u++) l = e, u !== p && (l = C.clone(l, !0, !0), a && C.merge(s, pe(l, "script"))), o.call(n[u], l, u);
            if (a)
                for (c = s[s.length - 1].ownerDocument, C.map(s, je), u = 0; u < a; u++) l = s[u], ue.test(l.type || "") && !K.access(l, "globalEval") && C.contains(c, l) && (l.src && "module" !== (l.type || "").toLowerCase() ? C._evalUrl && C._evalUrl(l.src) : w(l.textContent.replace(Ne, ""), c, l))
        }
        return n
    }

    function He(e, t, n) {
        for (var i, o = t ? C.filter(t, e) : e, r = 0; null != (i = o[r]); r++) n || 1 !== i.nodeType || C.cleanData(pe(i)), i.parentNode && (n && C.contains(i.ownerDocument, i) && fe(pe(i, "script")), i.parentNode.removeChild(i));
        return e
    }
    C.extend({
        htmlPrefilter: function(e) {
            return e.replace(Ee, "<$1></$2>")
        },
        clone: function(e, t, n) {
            var i, o, r, s, a, l, c, u = e.cloneNode(!0),
                d = C.contains(e.ownerDocument, e);
            if (!(v.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || C.isXMLDoc(e)))
                for (s = pe(u), i = 0, o = (r = pe(e)).length; i < o; i++) a = r[i], l = s[i], void 0, "input" === (c = l.nodeName.toLowerCase()) && le.test(a.type) ? l.checked = a.checked : "input" !== c && "textarea" !== c || (l.defaultValue = a.defaultValue);
            if (t)
                if (n)
                    for (r = r || pe(e), s = s || pe(u), i = 0, o = r.length; i < o; i++) Le(r[i], s[i]);
                else Le(e, u);
            return 0 < (s = pe(u, "script")).length && fe(s, !d && pe(e, "script")), u
        },
        cleanData: function(e) {
            for (var t, n, i, o = C.event.special, r = 0; void 0 !== (n = e[r]); r++)
                if (X(n)) {
                    if (t = n[K.expando]) {
                        if (t.events)
                            for (i in t.events) o[i] ? C.event.remove(n, i) : C.removeEvent(n, i, t.handle);
                        n[K.expando] = void 0
                    }
                    n[Q.expando] && (n[Q.expando] = void 0)
                }
        }
    }), C.fn.extend({
        detach: function(e) {
            return He(this, e, !0)
        },
        remove: function(e) {
            return He(this, e)
        },
        text: function(e) {
            return W(this, function(e) {
                return void 0 === e ? C.text(this) : this.empty().each(function() {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e)
                })
            }, null, e, arguments.length)
        },
        append: function() {
            return Pe(this, arguments, function(e) {
                1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || Oe(this, e).appendChild(e)
            })
        },
        prepend: function() {
            return Pe(this, arguments, function(e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = Oe(this, e);
                    t.insertBefore(e, t.firstChild)
                }
            })
        },
        before: function() {
            return Pe(this, arguments, function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        },
        after: function() {
            return Pe(this, arguments, function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        },
        empty: function() {
            for (var e, t = 0; null != (e = this[t]); t++) 1 === e.nodeType && (C.cleanData(pe(e, !1)), e.textContent = "");
            return this
        },
        clone: function(e, t) {
            return e = null != e && e, t = null == t ? e : t, this.map(function() {
                return C.clone(this, e, t)
            })
        },
        html: function(e) {
            return W(this, function(e) {
                var t = this[0] || {},
                    n = 0,
                    i = this.length;
                if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
                if ("string" == typeof e && !Ae.test(e) && !de[(ce.exec(e) || ["", ""])[1].toLowerCase()]) {
                    e = C.htmlPrefilter(e);
                    try {
                        for (; n < i; n++) 1 === (t = this[n] || {}).nodeType && (C.cleanData(pe(t, !1)), t.innerHTML = e);
                        t = 0
                    } catch (e) {}
                }
                t && this.empty().append(e)
            }, null, e, arguments.length)
        },
        replaceWith: function() {
            var n = [];
            return Pe(this, arguments, function(e) {
                var t = this.parentNode;
                C.inArray(this, n) < 0 && (C.cleanData(pe(this)), t && t.replaceChild(e, this))
            }, n)
        }
    }), C.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(e, s) {
        C.fn[e] = function(e) {
            for (var t, n = [], i = C(e), o = i.length - 1, r = 0; r <= o; r++) t = r === o ? this : this.clone(!0), C(i[r])[s](t), l.apply(n, t.get());
            return this.pushStack(n)
        }
    });
    var Me = new RegExp("^(" + ee + ")(?!px)[a-z%]+$", "i"),
        qe = function(e) {
            var t = e.ownerDocument.defaultView;
            return t && t.opener || (t = S), t.getComputedStyle(e)
        },
        Ie = new RegExp(ne.join("|"), "i");

    function Fe(e, t, n) {
        var i, o, r, s, a = e.style;
        return (n = n || qe(e)) && ("" !== (s = n.getPropertyValue(t) || n[t]) || C.contains(e.ownerDocument, e) || (s = C.style(e, t)), !v.pixelBoxStyles() && Me.test(s) && Ie.test(t) && (i = a.width, o = a.minWidth, r = a.maxWidth, a.minWidth = a.maxWidth = a.width = s, s = n.width, a.width = i, a.minWidth = o, a.maxWidth = r)), void 0 !== s ? s + "" : s
    }

    function _e(e, t) {
        return {
            get: function() {
                if (!e()) return (this.get = t).apply(this, arguments);
                delete this.get
            }
        }
    }! function() {
        function e() {
            if (l) {
                a.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0", l.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%", ye.appendChild(a).appendChild(l);
                var e = S.getComputedStyle(l);
                n = "1%" !== e.top, s = 12 === t(e.marginLeft), l.style.right = "60%", r = 36 === t(e.right), i = 36 === t(e.width), l.style.position = "absolute", o = 36 === l.offsetWidth || "absolute", ye.removeChild(a), l = null
            }
        }

        function t(e) {
            return Math.round(parseFloat(e))
        }
        var n, i, o, r, s, a = T.createElement("div"),
            l = T.createElement("div");
        l.style && (l.style.backgroundClip = "content-box", l.cloneNode(!0).style.backgroundClip = "", v.clearCloneStyle = "content-box" === l.style.backgroundClip, C.extend(v, {
            boxSizingReliable: function() {
                return e(), i
            },
            pixelBoxStyles: function() {
                return e(), r
            },
            pixelPosition: function() {
                return e(), n
            },
            reliableMarginLeft: function() {
                return e(), s
            },
            scrollboxSize: function() {
                return e(), o
            }
        }))
    }();
    var ze = /^(none|table(?!-c[ea]).+)/,
        We = /^--/,
        Re = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        Ue = {
            letterSpacing: "0",
            fontWeight: "400"
        },
        Be = ["Webkit", "Moz", "ms"],
        Ve = T.createElement("div").style;

    function Xe(e) {
        var t = C.cssProps[e];
        return t || (t = C.cssProps[e] = function(e) {
            if (e in Ve) return e;
            for (var t = e[0].toUpperCase() + e.slice(1), n = Be.length; n--;)
                if ((e = Be[n] + t) in Ve) return e
        }(e) || e), t
    }

    function Ye(e, t, n) {
        var i = te.exec(t);
        return i ? Math.max(0, i[2] - (n || 0)) + (i[3] || "px") : t
    }

    function Ke(e, t, n, i, o, r) {
        var s = "width" === t ? 1 : 0,
            a = 0,
            l = 0;
        if (n === (i ? "border" : "content")) return 0;
        for (; s < 4; s += 2) "margin" === n && (l += C.css(e, n + ne[s], !0, o)), i ? ("content" === n && (l -= C.css(e, "padding" + ne[s], !0, o)), "margin" !== n && (l -= C.css(e, "border" + ne[s] + "Width", !0, o))) : (l += C.css(e, "padding" + ne[s], !0, o), "padding" !== n ? l += C.css(e, "border" + ne[s] + "Width", !0, o) : a += C.css(e, "border" + ne[s] + "Width", !0, o));
        return !i && 0 <= r && (l += Math.max(0, Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - r - l - a - .5))), l
    }

    function Qe(e, t, n) {
        var i = qe(e),
            o = Fe(e, t, i),
            r = "border-box" === C.css(e, "boxSizing", !1, i),
            s = r;
        if (Me.test(o)) {
            if (!n) return o;
            o = "auto"
        }
        return s = s && (v.boxSizingReliable() || o === e.style[t]), ("auto" === o || !parseFloat(o) && "inline" === C.css(e, "display", !1, i)) && (o = e["offset" + t[0].toUpperCase() + t.slice(1)], s = !0), (o = parseFloat(o) || 0) + Ke(e, t, n || (r ? "border" : "content"), s, i, o) + "px"
    }

    function Ge(e, t, n, i, o) {
        return new Ge.prototype.init(e, t, n, i, o)
    }
    C.extend({
        cssHooks: {
            opacity: {
                get: function(e, t) {
                    if (t) {
                        var n = Fe(e, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {},
        style: function(e, t, n, i) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var o, r, s, a = V(t),
                    l = We.test(t),
                    c = e.style;
                if (l || (t = Xe(a)), s = C.cssHooks[t] || C.cssHooks[a], void 0 === n) return s && "get" in s && void 0 !== (o = s.get(e, !1, i)) ? o : c[t];
                "string" == (r = typeof n) && (o = te.exec(n)) && o[1] && (n = re(e, t, o), r = "number"), null != n && n == n && ("number" === r && (n += o && o[3] || (C.cssNumber[a] ? "" : "px")), v.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (c[t] = "inherit"), s && "set" in s && void 0 === (n = s.set(e, n, i)) || (l ? c.setProperty(t, n) : c[t] = n))
            }
        },
        css: function(e, t, n, i) {
            var o, r, s, a = V(t);
            return We.test(t) || (t = Xe(a)), (s = C.cssHooks[t] || C.cssHooks[a]) && "get" in s && (o = s.get(e, !0, n)), void 0 === o && (o = Fe(e, t, i)), "normal" === o && t in Ue && (o = Ue[t]), "" === n || n ? (r = parseFloat(o), !0 === n || isFinite(r) ? r || 0 : o) : o
        }
    }), C.each(["height", "width"], function(e, a) {
        C.cssHooks[a] = {
            get: function(e, t, n) {
                if (t) return !ze.test(C.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? Qe(e, a, n) : oe(e, Re, function() {
                    return Qe(e, a, n)
                })
            },
            set: function(e, t, n) {
                var i, o = qe(e),
                    r = "border-box" === C.css(e, "boxSizing", !1, o),
                    s = n && Ke(e, a, n, r, o);
                return r && v.scrollboxSize() === o.position && (s -= Math.ceil(e["offset" + a[0].toUpperCase() + a.slice(1)] - parseFloat(o[a]) - Ke(e, a, "border", !1, o) - .5)), s && (i = te.exec(t)) && "px" !== (i[3] || "px") && (e.style[a] = t, t = C.css(e, a)), Ye(0, t, s)
            }
        }
    }), C.cssHooks.marginLeft = _e(v.reliableMarginLeft, function(e, t) {
        if (t) return (parseFloat(Fe(e, "marginLeft")) || e.getBoundingClientRect().left - oe(e, {
            marginLeft: 0
        }, function() {
            return e.getBoundingClientRect().left
        })) + "px"
    }), C.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function(o, r) {
        C.cssHooks[o + r] = {
            expand: function(e) {
                for (var t = 0, n = {}, i = "string" == typeof e ? e.split(" ") : [e]; t < 4; t++) n[o + ne[t] + r] = i[t] || i[t - 2] || i[0];
                return n
            }
        }, "margin" !== o && (C.cssHooks[o + r].set = Ye)
    }), C.fn.extend({
        css: function(e, t) {
            return W(this, function(e, t, n) {
                var i, o, r = {},
                    s = 0;
                if (Array.isArray(t)) {
                    for (i = qe(e), o = t.length; s < o; s++) r[t[s]] = C.css(e, t[s], !1, i);
                    return r
                }
                return void 0 !== n ? C.style(e, t, n) : C.css(e, t)
            }, e, t, 1 < arguments.length)
        }
    }), ((C.Tween = Ge).prototype = {
        constructor: Ge,
        init: function(e, t, n, i, o, r) {
            this.elem = e, this.prop = n, this.easing = o || C.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = i, this.unit = r || (C.cssNumber[n] ? "" : "px")
        },
        cur: function() {
            var e = Ge.propHooks[this.prop];
            return e && e.get ? e.get(this) : Ge.propHooks._default.get(this)
        },
        run: function(e) {
            var t, n = Ge.propHooks[this.prop];
            return this.options.duration ? this.pos = t = C.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : Ge.propHooks._default.set(this), this
        }
    }).init.prototype = Ge.prototype, (Ge.propHooks = {
        _default: {
            get: function(e) {
                var t;
                return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = C.css(e.elem, e.prop, "")) && "auto" !== t ? t : 0
            },
            set: function(e) {
                C.fx.step[e.prop] ? C.fx.step[e.prop](e) : 1 !== e.elem.nodeType || null == e.elem.style[C.cssProps[e.prop]] && !C.cssHooks[e.prop] ? e.elem[e.prop] = e.now : C.style(e.elem, e.prop, e.now + e.unit)
            }
        }
    }).scrollTop = Ge.propHooks.scrollLeft = {
        set: function(e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, C.easing = {
        linear: function(e) {
            return e
        },
        swing: function(e) {
            return .5 - Math.cos(e * Math.PI) / 2
        },
        _default: "swing"
    }, C.fx = Ge.prototype.init, C.fx.step = {};
    var Je, Ze, et, tt, nt = /^(?:toggle|show|hide)$/,
        it = /queueHooks$/;

    function ot() {
        Ze && (!1 === T.hidden && S.requestAnimationFrame ? S.requestAnimationFrame(ot) : S.setTimeout(ot, C.fx.interval), C.fx.tick())
    }

    function rt() {
        return S.setTimeout(function() {
            Je = void 0
        }), Je = Date.now()
    }

    function st(e, t) {
        var n, i = 0,
            o = {
                height: e
            };
        for (t = t ? 1 : 0; i < 4; i += 2 - t) o["margin" + (n = ne[i])] = o["padding" + n] = e;
        return t && (o.opacity = o.width = e), o
    }

    function at(e, t, n) {
        for (var i, o = (lt.tweeners[t] || []).concat(lt.tweeners["*"]), r = 0, s = o.length; r < s; r++)
            if (i = o[r].call(n, t, e)) return i
    }

    function lt(r, e, t) {
        var n, s, i = 0,
            o = lt.prefilters.length,
            a = C.Deferred().always(function() {
                delete l.elem
            }),
            l = function() {
                if (s) return !1;
                for (var e = Je || rt(), t = Math.max(0, c.startTime + c.duration - e), n = 1 - (t / c.duration || 0), i = 0, o = c.tweens.length; i < o; i++) c.tweens[i].run(n);
                return a.notifyWith(r, [c, n, t]), n < 1 && o ? t : (o || a.notifyWith(r, [c, 1, 0]), a.resolveWith(r, [c]), !1)
            },
            c = a.promise({
                elem: r,
                props: C.extend({}, e),
                opts: C.extend(!0, {
                    specialEasing: {},
                    easing: C.easing._default
                }, t),
                originalProperties: e,
                originalOptions: t,
                startTime: Je || rt(),
                duration: t.duration,
                tweens: [],
                createTween: function(e, t) {
                    var n = C.Tween(r, c.opts, e, t, c.opts.specialEasing[e] || c.opts.easing);
                    return c.tweens.push(n), n
                },
                stop: function(e) {
                    var t = 0,
                        n = e ? c.tweens.length : 0;
                    if (s) return this;
                    for (s = !0; t < n; t++) c.tweens[t].run(1);
                    return e ? (a.notifyWith(r, [c, 1, 0]), a.resolveWith(r, [c, e])) : a.rejectWith(r, [c, e]), this
                }
            }),
            u = c.props;
        for (function(e, t) {
                var n, i, o, r, s;
                for (n in e)
                    if (o = t[i = V(n)], r = e[n], Array.isArray(r) && (o = r[1], r = e[n] = r[0]), n !== i && (e[i] = r, delete e[n]), (s = C.cssHooks[i]) && "expand" in s)
                        for (n in r = s.expand(r), delete e[i], r) n in e || (e[n] = r[n], t[n] = o);
                    else t[i] = o
            }(u, c.opts.specialEasing); i < o; i++)
            if (n = lt.prefilters[i].call(c, r, u, c.opts)) return y(n.stop) && (C._queueHooks(c.elem, c.opts.queue).stop = n.stop.bind(n)), n;
        return C.map(u, at, c), y(c.opts.start) && c.opts.start.call(r, c), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always), C.fx.timer(C.extend(l, {
            elem: r,
            anim: c,
            queue: c.opts.queue
        })), c
    }
    C.Animation = C.extend(lt, {
        tweeners: {
            "*": [function(e, t) {
                var n = this.createTween(e, t);
                return re(n.elem, e, te.exec(t), n), n
            }]
        },
        tweener: function(e, t) {
            y(e) ? (t = e, e = ["*"]) : e = e.match(H);
            for (var n, i = 0, o = e.length; i < o; i++) n = e[i], lt.tweeners[n] = lt.tweeners[n] || [], lt.tweeners[n].unshift(t)
        },
        prefilters: [function(e, t, n) {
            var i, o, r, s, a, l, c, u, d = "width" in t || "height" in t,
                p = this,
                f = {},
                h = e.style,
                g = e.nodeType && ie(e),
                m = K.get(e, "fxshow");
            for (i in n.queue || (null == (s = C._queueHooks(e, "fx")).unqueued && (s.unqueued = 0, a = s.empty.fire, s.empty.fire = function() {
                    s.unqueued || a()
                }), s.unqueued++, p.always(function() {
                    p.always(function() {
                        s.unqueued--, C.queue(e, "fx").length || s.empty.fire()
                    })
                })), t)
                if (o = t[i], nt.test(o)) {
                    if (delete t[i], r = r || "toggle" === o, o === (g ? "hide" : "show")) {
                        if ("show" !== o || !m || void 0 === m[i]) continue;
                        g = !0
                    }
                    f[i] = m && m[i] || C.style(e, i)
                }
            if ((l = !C.isEmptyObject(t)) || !C.isEmptyObject(f))
                for (i in d && 1 === e.nodeType && (n.overflow = [h.overflow, h.overflowX, h.overflowY], null == (c = m && m.display) && (c = K.get(e, "display")), "none" === (u = C.css(e, "display")) && (c ? u = c : (ae([e], !0), c = e.style.display || c, u = C.css(e, "display"), ae([e]))), ("inline" === u || "inline-block" === u && null != c) && "none" === C.css(e, "float") && (l || (p.done(function() {
                        h.display = c
                    }), null == c && (u = h.display, c = "none" === u ? "" : u)), h.display = "inline-block")), n.overflow && (h.overflow = "hidden", p.always(function() {
                        h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
                    })), l = !1, f) l || (m ? "hidden" in m && (g = m.hidden) : m = K.access(e, "fxshow", {
                    display: c
                }), r && (m.hidden = !g), g && ae([e], !0), p.done(function() {
                    for (i in g || ae([e]), K.remove(e, "fxshow"), f) C.style(e, i, f[i])
                })), l = at(g ? m[i] : 0, i, p), i in m || (m[i] = l.start, g && (l.end = l.start, l.start = 0))
        }],
        prefilter: function(e, t) {
            t ? lt.prefilters.unshift(e) : lt.prefilters.push(e)
        }
    }), C.speed = function(e, t, n) {
        var i = e && "object" == typeof e ? C.extend({}, e) : {
            complete: n || !n && t || y(e) && e,
            duration: e,
            easing: n && t || t && !y(t) && t
        };
        return C.fx.off ? i.duration = 0 : "number" != typeof i.duration && (i.duration in C.fx.speeds ? i.duration = C.fx.speeds[i.duration] : i.duration = C.fx.speeds._default), null != i.queue && !0 !== i.queue || (i.queue = "fx"), i.old = i.complete, i.complete = function() {
            y(i.old) && i.old.call(this), i.queue && C.dequeue(this, i.queue)
        }, i
    }, C.fn.extend({
        fadeTo: function(e, t, n, i) {
            return this.filter(ie).css("opacity", 0).show().end().animate({
                opacity: t
            }, e, n, i)
        },
        animate: function(t, e, n, i) {
            var o = C.isEmptyObject(t),
                r = C.speed(e, n, i),
                s = function() {
                    var e = lt(this, C.extend({}, t), r);
                    (o || K.get(this, "finish")) && e.stop(!0)
                };
            return s.finish = s, o || !1 === r.queue ? this.each(s) : this.queue(r.queue, s)
        },
        stop: function(o, e, r) {
            var s = function(e) {
                var t = e.stop;
                delete e.stop, t(r)
            };
            return "string" != typeof o && (r = e, e = o, o = void 0), e && !1 !== o && this.queue(o || "fx", []), this.each(function() {
                var e = !0,
                    t = null != o && o + "queueHooks",
                    n = C.timers,
                    i = K.get(this);
                if (t) i[t] && i[t].stop && s(i[t]);
                else
                    for (t in i) i[t] && i[t].stop && it.test(t) && s(i[t]);
                for (t = n.length; t--;) n[t].elem !== this || null != o && n[t].queue !== o || (n[t].anim.stop(r), e = !1, n.splice(t, 1));
                !e && r || C.dequeue(this, o)
            })
        },
        finish: function(s) {
            return !1 !== s && (s = s || "fx"), this.each(function() {
                var e, t = K.get(this),
                    n = t[s + "queue"],
                    i = t[s + "queueHooks"],
                    o = C.timers,
                    r = n ? n.length : 0;
                for (t.finish = !0, C.queue(this, s, []), i && i.stop && i.stop.call(this, !0), e = o.length; e--;) o[e].elem === this && o[e].queue === s && (o[e].anim.stop(!0), o.splice(e, 1));
                for (e = 0; e < r; e++) n[e] && n[e].finish && n[e].finish.call(this);
                delete t.finish
            })
        }
    }), C.each(["toggle", "show", "hide"], function(e, i) {
        var o = C.fn[i];
        C.fn[i] = function(e, t, n) {
            return null == e || "boolean" == typeof e ? o.apply(this, arguments) : this.animate(st(i, !0), e, t, n)
        }
    }), C.each({
        slideDown: st("show"),
        slideUp: st("hide"),
        slideToggle: st("toggle"),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        },
        fadeToggle: {
            opacity: "toggle"
        }
    }, function(e, i) {
        C.fn[e] = function(e, t, n) {
            return this.animate(i, e, t, n)
        }
    }), C.timers = [], C.fx.tick = function() {
        var e, t = 0,
            n = C.timers;
        for (Je = Date.now(); t < n.length; t++)(e = n[t])() || n[t] !== e || n.splice(t--, 1);
        n.length || C.fx.stop(), Je = void 0
    }, C.fx.timer = function(e) {
        C.timers.push(e), C.fx.start()
    }, C.fx.interval = 13, C.fx.start = function() {
        Ze || (Ze = !0, ot())
    }, C.fx.stop = function() {
        Ze = null
    }, C.fx.speeds = {
        slow: 600,
        fast: 200,
        _default: 400
    }, C.fn.delay = function(i, e) {
        return i = C.fx && C.fx.speeds[i] || i, e = e || "fx", this.queue(e, function(e, t) {
            var n = S.setTimeout(e, i);
            t.stop = function() {
                S.clearTimeout(n)
            }
        })
    }, et = T.createElement("input"), tt = T.createElement("select").appendChild(T.createElement("option")), et.type = "checkbox", v.checkOn = "" !== et.value, v.optSelected = tt.selected, (et = T.createElement("input")).value = "t", et.type = "radio", v.radioValue = "t" === et.value;
    var ct, ut = C.expr.attrHandle;
    C.fn.extend({
        attr: function(e, t) {
            return W(this, C.attr, e, t, 1 < arguments.length)
        },
        removeAttr: function(e) {
            return this.each(function() {
                C.removeAttr(this, e)
            })
        }
    }), C.extend({
        attr: function(e, t, n) {
            var i, o, r = e.nodeType;
            if (3 !== r && 8 !== r && 2 !== r) return void 0 === e.getAttribute ? C.prop(e, t, n) : (1 === r && C.isXMLDoc(e) || (o = C.attrHooks[t.toLowerCase()] || (C.expr.match.bool.test(t) ? ct : void 0)), void 0 !== n ? null === n ? void C.removeAttr(e, t) : o && "set" in o && void 0 !== (i = o.set(e, n, t)) ? i : (e.setAttribute(t, n + ""), n) : o && "get" in o && null !== (i = o.get(e, t)) ? i : null == (i = C.find.attr(e, t)) ? void 0 : i)
        },
        attrHooks: {
            type: {
                set: function(e, t) {
                    if (!v.radioValue && "radio" === t && A(e, "input")) {
                        var n = e.value;
                        return e.setAttribute("type", t), n && (e.value = n), t
                    }
                }
            }
        },
        removeAttr: function(e, t) {
            var n, i = 0,
                o = t && t.match(H);
            if (o && 1 === e.nodeType)
                for (; n = o[i++];) e.removeAttribute(n)
        }
    }), ct = {
        set: function(e, t, n) {
            return !1 === t ? C.removeAttr(e, n) : e.setAttribute(n, n), n
        }
    }, C.each(C.expr.match.bool.source.match(/\w+/g), function(e, t) {
        var s = ut[t] || C.find.attr;
        ut[t] = function(e, t, n) {
            var i, o, r = t.toLowerCase();
            return n || (o = ut[r], ut[r] = i, i = null != s(e, t, n) ? r : null, ut[r] = o), i
        }
    });
    var dt = /^(?:input|select|textarea|button)$/i,
        pt = /^(?:a|area)$/i;

    function ft(e) {
        return (e.match(H) || []).join(" ")
    }

    function ht(e) {
        return e.getAttribute && e.getAttribute("class") || ""
    }

    function gt(e) {
        return Array.isArray(e) ? e : "string" == typeof e && e.match(H) || []
    }
    C.fn.extend({
        prop: function(e, t) {
            return W(this, C.prop, e, t, 1 < arguments.length)
        },
        removeProp: function(e) {
            return this.each(function() {
                delete this[C.propFix[e] || e]
            })
        }
    }), C.extend({
        prop: function(e, t, n) {
            var i, o, r = e.nodeType;
            if (3 !== r && 8 !== r && 2 !== r) return 1 === r && C.isXMLDoc(e) || (t = C.propFix[t] || t, o = C.propHooks[t]), void 0 !== n ? o && "set" in o && void 0 !== (i = o.set(e, n, t)) ? i : e[t] = n : o && "get" in o && null !== (i = o.get(e, t)) ? i : e[t]
        },
        propHooks: {
            tabIndex: {
                get: function(e) {
                    var t = C.find.attr(e, "tabindex");
                    return t ? parseInt(t, 10) : dt.test(e.nodeName) || pt.test(e.nodeName) && e.href ? 0 : -1
                }
            }
        },
        propFix: {
            for: "htmlFor",
            class: "className"
        }
    }), v.optSelected || (C.propHooks.selected = {
        get: function(e) {
            var t = e.parentNode;
            return t && t.parentNode && t.parentNode.selectedIndex, null
        },
        set: function(e) {
            var t = e.parentNode;
            t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
        }
    }), C.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
        C.propFix[this.toLowerCase()] = this
    }), C.fn.extend({
        addClass: function(t) {
            var e, n, i, o, r, s, a, l = 0;
            if (y(t)) return this.each(function(e) {
                C(this).addClass(t.call(this, e, ht(this)))
            });
            if ((e = gt(t)).length)
                for (; n = this[l++];)
                    if (o = ht(n), i = 1 === n.nodeType && " " + ft(o) + " ") {
                        for (s = 0; r = e[s++];) i.indexOf(" " + r + " ") < 0 && (i += r + " ");
                        o !== (a = ft(i)) && n.setAttribute("class", a)
                    }
            return this
        },
        removeClass: function(t) {
            var e, n, i, o, r, s, a, l = 0;
            if (y(t)) return this.each(function(e) {
                C(this).removeClass(t.call(this, e, ht(this)))
            });
            if (!arguments.length) return this.attr("class", "");
            if ((e = gt(t)).length)
                for (; n = this[l++];)
                    if (o = ht(n), i = 1 === n.nodeType && " " + ft(o) + " ") {
                        for (s = 0; r = e[s++];)
                            for (; - 1 < i.indexOf(" " + r + " ");) i = i.replace(" " + r + " ", " ");
                        o !== (a = ft(i)) && n.setAttribute("class", a)
                    }
            return this
        },
        toggleClass: function(o, t) {
            var r = typeof o,
                s = "string" === r || Array.isArray(o);
            return "boolean" == typeof t && s ? t ? this.addClass(o) : this.removeClass(o) : y(o) ? this.each(function(e) {
                C(this).toggleClass(o.call(this, e, ht(this), t), t)
            }) : this.each(function() {
                var e, t, n, i;
                if (s)
                    for (t = 0, n = C(this), i = gt(o); e = i[t++];) n.hasClass(e) ? n.removeClass(e) : n.addClass(e);
                else void 0 !== o && "boolean" !== r || ((e = ht(this)) && K.set(this, "__className__", e), this.setAttribute && this.setAttribute("class", e || !1 === o ? "" : K.get(this, "__className__") || ""))
            })
        },
        hasClass: function(e) {
            var t, n, i = 0;
            for (t = " " + e + " "; n = this[i++];)
                if (1 === n.nodeType && -1 < (" " + ft(ht(n)) + " ").indexOf(t)) return !0;
            return !1
        }
    });
    var mt = /\r/g;
    C.fn.extend({
        val: function(n) {
            var i, e, o, t = this[0];
            return arguments.length ? (o = y(n), this.each(function(e) {
                var t;
                1 === this.nodeType && (null == (t = o ? n.call(this, e, C(this).val()) : n) ? t = "" : "number" == typeof t ? t += "" : Array.isArray(t) && (t = C.map(t, function(e) {
                    return null == e ? "" : e + ""
                })), (i = C.valHooks[this.type] || C.valHooks[this.nodeName.toLowerCase()]) && "set" in i && void 0 !== i.set(this, t, "value") || (this.value = t))
            })) : t ? (i = C.valHooks[t.type] || C.valHooks[t.nodeName.toLowerCase()]) && "get" in i && void 0 !== (e = i.get(t, "value")) ? e : "string" == typeof(e = t.value) ? e.replace(mt, "") : null == e ? "" : e : void 0
        }
    }), C.extend({
        valHooks: {
            option: {
                get: function(e) {
                    var t = C.find.attr(e, "value");
                    return null != t ? t : ft(C.text(e))
                }
            },
            select: {
                get: function(e) {
                    var t, n, i, o = e.options,
                        r = e.selectedIndex,
                        s = "select-one" === e.type,
                        a = s ? null : [],
                        l = s ? r + 1 : o.length;
                    for (i = r < 0 ? l : s ? r : 0; i < l; i++)
                        if (((n = o[i]).selected || i === r) && !n.disabled && (!n.parentNode.disabled || !A(n.parentNode, "optgroup"))) {
                            if (t = C(n).val(), s) return t;
                            a.push(t)
                        }
                    return a
                },
                set: function(e, t) {
                    for (var n, i, o = e.options, r = C.makeArray(t), s = o.length; s--;)((i = o[s]).selected = -1 < C.inArray(C.valHooks.option.get(i), r)) && (n = !0);
                    return n || (e.selectedIndex = -1), r
                }
            }
        }
    }), C.each(["radio", "checkbox"], function() {
        C.valHooks[this] = {
            set: function(e, t) {
                if (Array.isArray(t)) return e.checked = -1 < C.inArray(C(e).val(), t)
            }
        }, v.checkOn || (C.valHooks[this].get = function(e) {
            return null === e.getAttribute("value") ? "on" : e.value
        })
    }), v.focusin = "onfocusin" in S;
    var vt = /^(?:focusinfocus|focusoutblur)$/,
        yt = function(e) {
            e.stopPropagation()
        };
    C.extend(C.event, {
        trigger: function(e, t, n, i) {
            var o, r, s, a, l, c, u, d, p = [n || T],
                f = m.call(e, "type") ? e.type : e,
                h = m.call(e, "namespace") ? e.namespace.split(".") : [];
            if (r = d = s = n = n || T, 3 !== n.nodeType && 8 !== n.nodeType && !vt.test(f + C.event.triggered) && (-1 < f.indexOf(".") && (f = (h = f.split(".")).shift(), h.sort()), l = f.indexOf(":") < 0 && "on" + f, (e = e[C.expando] ? e : new C.Event(f, "object" == typeof e && e)).isTrigger = i ? 2 : 3, e.namespace = h.join("."), e.rnamespace = e.namespace ? new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = n), t = null == t ? [e] : C.makeArray(t, [e]), u = C.event.special[f] || {}, i || !u.trigger || !1 !== u.trigger.apply(n, t))) {
                if (!i && !u.noBubble && !b(n)) {
                    for (a = u.delegateType || f, vt.test(a + f) || (r = r.parentNode); r; r = r.parentNode) p.push(r), s = r;
                    s === (n.ownerDocument || T) && p.push(s.defaultView || s.parentWindow || S)
                }
                for (o = 0;
                    (r = p[o++]) && !e.isPropagationStopped();) d = r, e.type = 1 < o ? a : u.bindType || f, (c = (K.get(r, "events") || {})[e.type] && K.get(r, "handle")) && c.apply(r, t), (c = l && r[l]) && c.apply && X(r) && (e.result = c.apply(r, t), !1 === e.result && e.preventDefault());
                return e.type = f, i || e.isDefaultPrevented() || u._default && !1 !== u._default.apply(p.pop(), t) || !X(n) || l && y(n[f]) && !b(n) && ((s = n[l]) && (n[l] = null), C.event.triggered = f, e.isPropagationStopped() && d.addEventListener(f, yt), n[f](), e.isPropagationStopped() && d.removeEventListener(f, yt), C.event.triggered = void 0, s && (n[l] = s)), e.result
            }
        },
        simulate: function(e, t, n) {
            var i = C.extend(new C.Event, n, {
                type: e,
                isSimulated: !0
            });
            C.event.trigger(i, null, t)
        }
    }), C.fn.extend({
        trigger: function(e, t) {
            return this.each(function() {
                C.event.trigger(e, t, this)
            })
        },
        triggerHandler: function(e, t) {
            var n = this[0];
            if (n) return C.event.trigger(e, t, n, !0)
        }
    }), v.focusin || C.each({
        focus: "focusin",
        blur: "focusout"
    }, function(n, i) {
        var o = function(e) {
            C.event.simulate(i, e.target, C.event.fix(e))
        };
        C.event.special[i] = {
            setup: function() {
                var e = this.ownerDocument || this,
                    t = K.access(e, i);
                t || e.addEventListener(n, o, !0), K.access(e, i, (t || 0) + 1)
            },
            teardown: function() {
                var e = this.ownerDocument || this,
                    t = K.access(e, i) - 1;
                t ? K.access(e, i, t) : (e.removeEventListener(n, o, !0), K.remove(e, i))
            }
        }
    });
    var bt = S.location,
        wt = Date.now(),
        xt = /\?/;
    C.parseXML = function(e) {
        var t;
        if (!e || "string" != typeof e) return null;
        try {
            t = (new S.DOMParser).parseFromString(e, "text/xml")
        } catch (e) {
            t = void 0
        }
        return t && !t.getElementsByTagName("parsererror").length || C.error("Invalid XML: " + e), t
    };
    var kt = /\[\]$/,
        St = /\r?\n/g,
        Tt = /^(?:submit|button|image|reset|file)$/i,
        Ct = /^(?:input|select|textarea|keygen)/i;

    function Et(n, e, i, o) {
        var t;
        if (Array.isArray(e)) C.each(e, function(e, t) {
            i || kt.test(n) ? o(n, t) : Et(n + "[" + ("object" == typeof t && null != t ? e : "") + "]", t, i, o)
        });
        else if (i || "object" !== x(e)) o(n, e);
        else
            for (t in e) Et(n + "[" + t + "]", e[t], i, o)
    }
    C.param = function(e, t) {
        var n, i = [],
            o = function(e, t) {
                var n = y(t) ? t() : t;
                i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n)
            };
        if (Array.isArray(e) || e.jquery && !C.isPlainObject(e)) C.each(e, function() {
            o(this.name, this.value)
        });
        else
            for (n in e) Et(n, e[n], t, o);
        return i.join("&")
    }, C.fn.extend({
        serialize: function() {
            return C.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                var e = C.prop(this, "elements");
                return e ? C.makeArray(e) : this
            }).filter(function() {
                var e = this.type;
                return this.name && !C(this).is(":disabled") && Ct.test(this.nodeName) && !Tt.test(e) && (this.checked || !le.test(e))
            }).map(function(e, t) {
                var n = C(this).val();
                return null == n ? null : Array.isArray(n) ? C.map(n, function(e) {
                    return {
                        name: t.name,
                        value: e.replace(St, "\r\n")
                    }
                }) : {
                    name: t.name,
                    value: n.replace(St, "\r\n")
                }
            }).get()
        }
    });
    var At = /%20/g,
        $t = /#.*$/,
        Nt = /([?&])_=[^&]*/,
        Ot = /^(.*?):[ \t]*([^\r\n]*)$/gm,
        Dt = /^(?:GET|HEAD)$/,
        jt = /^\/\//,
        Lt = {},
        Pt = {},
        Ht = "*/".concat("*"),
        Mt = T.createElement("a");

    function qt(r) {
        return function(e, t) {
            "string" != typeof e && (t = e, e = "*");
            var n, i = 0,
                o = e.toLowerCase().match(H) || [];
            if (y(t))
                for (; n = o[i++];) "+" === n[0] ? (n = n.slice(1) || "*", (r[n] = r[n] || []).unshift(t)) : (r[n] = r[n] || []).push(t)
        }
    }

    function It(t, o, r, s) {
        var a = {},
            l = t === Pt;

        function c(e) {
            var i;
            return a[e] = !0, C.each(t[e] || [], function(e, t) {
                var n = t(o, r, s);
                return "string" != typeof n || l || a[n] ? l ? !(i = n) : void 0 : (o.dataTypes.unshift(n), c(n), !1)
            }), i
        }
        return c(o.dataTypes[0]) || !a["*"] && c("*")
    }

    function Ft(e, t) {
        var n, i, o = C.ajaxSettings.flatOptions || {};
        for (n in t) void 0 !== t[n] && ((o[n] ? e : i || (i = {}))[n] = t[n]);
        return i && C.extend(!0, e, i), e
    }
    Mt.href = bt.href, C.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: bt.href,
            type: "GET",
            isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(bt.protocol),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Ht,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /\bxml\b/,
                html: /\bhtml/,
                json: /\bjson\b/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": JSON.parse,
                "text xml": C.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(e, t) {
            return t ? Ft(Ft(e, C.ajaxSettings), t) : Ft(C.ajaxSettings, e)
        },
        ajaxPrefilter: qt(Lt),
        ajaxTransport: qt(Pt),
        ajax: function(e, t) {
            "object" == typeof e && (t = e, e = void 0), t = t || {};
            var u, d, p, n, f, i, h, g, o, r, m = C.ajaxSetup({}, t),
                v = m.context || m,
                y = m.context && (v.nodeType || v.jquery) ? C(v) : C.event,
                b = C.Deferred(),
                w = C.Callbacks("once memory"),
                x = m.statusCode || {},
                s = {},
                a = {},
                l = "canceled",
                k = {
                    readyState: 0,
                    getResponseHeader: function(e) {
                        var t;
                        if (h) {
                            if (!n)
                                for (n = {}; t = Ot.exec(p);) n[t[1].toLowerCase()] = t[2];
                            t = n[e.toLowerCase()]
                        }
                        return null == t ? null : t
                    },
                    getAllResponseHeaders: function() {
                        return h ? p : null
                    },
                    setRequestHeader: function(e, t) {
                        return null == h && (e = a[e.toLowerCase()] = a[e.toLowerCase()] || e, s[e] = t), this
                    },
                    overrideMimeType: function(e) {
                        return null == h && (m.mimeType = e), this
                    },
                    statusCode: function(e) {
                        var t;
                        if (e)
                            if (h) k.always(e[k.status]);
                            else
                                for (t in e) x[t] = [x[t], e[t]];
                        return this
                    },
                    abort: function(e) {
                        var t = e || l;
                        return u && u.abort(t), c(0, t), this
                    }
                };
            if (b.promise(k), m.url = ((e || m.url || bt.href) + "").replace(jt, bt.protocol + "//"), m.type = t.method || t.type || m.method || m.type, m.dataTypes = (m.dataType || "*").toLowerCase().match(H) || [""], null == m.crossDomain) {
                i = T.createElement("a");
                try {
                    i.href = m.url, i.href = i.href, m.crossDomain = Mt.protocol + "//" + Mt.host != i.protocol + "//" + i.host
                } catch (e) {
                    m.crossDomain = !0
                }
            }
            if (m.data && m.processData && "string" != typeof m.data && (m.data = C.param(m.data, m.traditional)), It(Lt, m, t, k), h) return k;
            for (o in (g = C.event && m.global) && 0 == C.active++ && C.event.trigger("ajaxStart"), m.type = m.type.toUpperCase(), m.hasContent = !Dt.test(m.type), d = m.url.replace($t, ""), m.hasContent ? m.data && m.processData && 0 === (m.contentType || "").indexOf("application/x-www-form-urlencoded") && (m.data = m.data.replace(At, "+")) : (r = m.url.slice(d.length), m.data && (m.processData || "string" == typeof m.data) && (d += (xt.test(d) ? "&" : "?") + m.data, delete m.data), !1 === m.cache && (d = d.replace(Nt, "$1"), r = (xt.test(d) ? "&" : "?") + "_=" + wt++ + r), m.url = d + r), m.ifModified && (C.lastModified[d] && k.setRequestHeader("If-Modified-Since", C.lastModified[d]), C.etag[d] && k.setRequestHeader("If-None-Match", C.etag[d])), (m.data && m.hasContent && !1 !== m.contentType || t.contentType) && k.setRequestHeader("Content-Type", m.contentType), k.setRequestHeader("Accept", m.dataTypes[0] && m.accepts[m.dataTypes[0]] ? m.accepts[m.dataTypes[0]] + ("*" !== m.dataTypes[0] ? ", " + Ht + "; q=0.01" : "") : m.accepts["*"]), m.headers) k.setRequestHeader(o, m.headers[o]);
            if (m.beforeSend && (!1 === m.beforeSend.call(v, k, m) || h)) return k.abort();
            if (l = "abort", w.add(m.complete), k.done(m.success), k.fail(m.error), u = It(Pt, m, t, k)) {
                if (k.readyState = 1, g && y.trigger("ajaxSend", [k, m]), h) return k;
                m.async && 0 < m.timeout && (f = S.setTimeout(function() {
                    k.abort("timeout")
                }, m.timeout));
                try {
                    h = !1, u.send(s, c)
                } catch (e) {
                    if (h) throw e;
                    c(-1, e)
                }
            } else c(-1, "No Transport");

            function c(e, t, n, i) {
                var o, r, s, a, l, c = t;
                h || (h = !0, f && S.clearTimeout(f), u = void 0, p = i || "", k.readyState = 0 < e ? 4 : 0, o = 200 <= e && e < 300 || 304 === e, n && (a = function(e, t, n) {
                    for (var i, o, r, s, a = e.contents, l = e.dataTypes;
                        "*" === l[0];) l.shift(), void 0 === i && (i = e.mimeType || t.getResponseHeader("Content-Type"));
                    if (i)
                        for (o in a)
                            if (a[o] && a[o].test(i)) {
                                l.unshift(o);
                                break
                            }
                    if (l[0] in n) r = l[0];
                    else {
                        for (o in n) {
                            if (!l[0] || e.converters[o + " " + l[0]]) {
                                r = o;
                                break
                            }
                            s || (s = o)
                        }
                        r = r || s
                    }
                    if (r) return r !== l[0] && l.unshift(r), n[r]
                }(m, k, n)), a = function(e, t, n, i) {
                    var o, r, s, a, l, c = {},
                        u = e.dataTypes.slice();
                    if (u[1])
                        for (s in e.converters) c[s.toLowerCase()] = e.converters[s];
                    for (r = u.shift(); r;)
                        if (e.responseFields[r] && (n[e.responseFields[r]] = t), !l && i && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = r, r = u.shift())
                            if ("*" === r) r = l;
                            else if ("*" !== l && l !== r) {
                        if (!(s = c[l + " " + r] || c["* " + r]))
                            for (o in c)
                                if ((a = o.split(" "))[1] === r && (s = c[l + " " + a[0]] || c["* " + a[0]])) {
                                    !0 === s ? s = c[o] : !0 !== c[o] && (r = a[0], u.unshift(a[1]));
                                    break
                                }
                        if (!0 !== s)
                            if (s && e.throws) t = s(t);
                            else try {
                                t = s(t)
                            } catch (e) {
                                return {
                                    state: "parsererror",
                                    error: s ? e : "No conversion from " + l + " to " + r
                                }
                            }
                    }
                    return {
                        state: "success",
                        data: t
                    }
                }(m, a, k, o), o ? (m.ifModified && ((l = k.getResponseHeader("Last-Modified")) && (C.lastModified[d] = l), (l = k.getResponseHeader("etag")) && (C.etag[d] = l)), 204 === e || "HEAD" === m.type ? c = "nocontent" : 304 === e ? c = "notmodified" : (c = a.state, r = a.data, o = !(s = a.error))) : (s = c, !e && c || (c = "error", e < 0 && (e = 0))), k.status = e, k.statusText = (t || c) + "", o ? b.resolveWith(v, [r, c, k]) : b.rejectWith(v, [k, c, s]), k.statusCode(x), x = void 0, g && y.trigger(o ? "ajaxSuccess" : "ajaxError", [k, m, o ? r : s]), w.fireWith(v, [k, c]), g && (y.trigger("ajaxComplete", [k, m]), --C.active || C.event.trigger("ajaxStop")))
            }
            return k
        },
        getJSON: function(e, t, n) {
            return C.get(e, t, n, "json")
        },
        getScript: function(e, t) {
            return C.get(e, void 0, t, "script")
        }
    }), C.each(["get", "post"], function(e, o) {
        C[o] = function(e, t, n, i) {
            return y(t) && (i = i || n, n = t, t = void 0), C.ajax(C.extend({
                url: e,
                type: o,
                dataType: i,
                data: t,
                success: n
            }, C.isPlainObject(e) && e))
        }
    }), C._evalUrl = function(e) {
        return C.ajax({
            url: e,
            type: "GET",
            dataType: "script",
            cache: !0,
            async: !1,
            global: !1,
            throws: !0
        })
    }, C.fn.extend({
        wrapAll: function(e) {
            var t;
            return this[0] && (y(e) && (e = e.call(this[0])), t = C(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function() {
                for (var e = this; e.firstElementChild;) e = e.firstElementChild;
                return e
            }).append(this)), this
        },
        wrapInner: function(n) {
            return y(n) ? this.each(function(e) {
                C(this).wrapInner(n.call(this, e))
            }) : this.each(function() {
                var e = C(this),
                    t = e.contents();
                t.length ? t.wrapAll(n) : e.append(n)
            })
        },
        wrap: function(t) {
            var n = y(t);
            return this.each(function(e) {
                C(this).wrapAll(n ? t.call(this, e) : t)
            })
        },
        unwrap: function(e) {
            return this.parent(e).not("body").each(function() {
                C(this).replaceWith(this.childNodes)
            }), this
        }
    }), C.expr.pseudos.hidden = function(e) {
        return !C.expr.pseudos.visible(e)
    }, C.expr.pseudos.visible = function(e) {
        return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length)
    }, C.ajaxSettings.xhr = function() {
        try {
            return new S.XMLHttpRequest
        } catch (e) {}
    };
    var _t = {
            0: 200,
            1223: 204
        },
        zt = C.ajaxSettings.xhr();
    v.cors = !!zt && "withCredentials" in zt, v.ajax = zt = !!zt, C.ajaxTransport(function(o) {
        var r, s;
        if (v.cors || zt && !o.crossDomain) return {
            send: function(e, t) {
                var n, i = o.xhr();
                if (i.open(o.type, o.url, o.async, o.username, o.password), o.xhrFields)
                    for (n in o.xhrFields) i[n] = o.xhrFields[n];
                for (n in o.mimeType && i.overrideMimeType && i.overrideMimeType(o.mimeType), o.crossDomain || e["X-Requested-With"] || (e["X-Requested-With"] = "XMLHttpRequest"), e) i.setRequestHeader(n, e[n]);
                r = function(e) {
                    return function() {
                        r && (r = s = i.onload = i.onerror = i.onabort = i.ontimeout = i.onreadystatechange = null, "abort" === e ? i.abort() : "error" === e ? "number" != typeof i.status ? t(0, "error") : t(i.status, i.statusText) : t(_t[i.status] || i.status, i.statusText, "text" !== (i.responseType || "text") || "string" != typeof i.responseText ? {
                            binary: i.response
                        } : {
                            text: i.responseText
                        }, i.getAllResponseHeaders()))
                    }
                }, i.onload = r(), s = i.onerror = i.ontimeout = r("error"), void 0 !== i.onabort ? i.onabort = s : i.onreadystatechange = function() {
                    4 === i.readyState && S.setTimeout(function() {
                        r && s()
                    })
                }, r = r("abort");
                try {
                    i.send(o.hasContent && o.data || null)
                } catch (e) {
                    if (r) throw e
                }
            },
            abort: function() {
                r && r()
            }
        }
    }), C.ajaxPrefilter(function(e) {
        e.crossDomain && (e.contents.script = !1)
    }), C.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /\b(?:java|ecma)script\b/
        },
        converters: {
            "text script": function(e) {
                return C.globalEval(e), e
            }
        }
    }), C.ajaxPrefilter("script", function(e) {
        void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
    }), C.ajaxTransport("script", function(n) {
        var i, o;
        if (n.crossDomain) return {
            send: function(e, t) {
                i = C("<script>").prop({
                    charset: n.scriptCharset,
                    src: n.url
                }).on("load error", o = function(e) {
                    i.remove(), o = null, e && t("error" === e.type ? 404 : 200, e.type)
                }), T.head.appendChild(i[0])
            },
            abort: function() {
                o && o()
            }
        }
    });
    var Wt, Rt = [],
        Ut = /(=)\?(?=&|$)|\?\?/;
    C.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var e = Rt.pop() || C.expando + "_" + wt++;
            return this[e] = !0, e
        }
    }), C.ajaxPrefilter("json jsonp", function(e, t, n) {
        var i, o, r, s = !1 !== e.jsonp && (Ut.test(e.url) ? "url" : "string" == typeof e.data && 0 === (e.contentType || "").indexOf("application/x-www-form-urlencoded") && Ut.test(e.data) && "data");
        if (s || "jsonp" === e.dataTypes[0]) return i = e.jsonpCallback = y(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, s ? e[s] = e[s].replace(Ut, "$1" + i) : !1 !== e.jsonp && (e.url += (xt.test(e.url) ? "&" : "?") + e.jsonp + "=" + i), e.converters["script json"] = function() {
            return r || C.error(i + " was not called"), r[0]
        }, e.dataTypes[0] = "json", o = S[i], S[i] = function() {
            r = arguments
        }, n.always(function() {
            void 0 === o ? C(S).removeProp(i) : S[i] = o, e[i] && (e.jsonpCallback = t.jsonpCallback, Rt.push(i)), r && y(o) && o(r[0]), r = o = void 0
        }), "script"
    }), v.createHTMLDocument = ((Wt = T.implementation.createHTMLDocument("").body).innerHTML = "<form></form><form></form>", 2 === Wt.childNodes.length), C.parseHTML = function(e, t, n) {
        return "string" != typeof e ? [] : ("boolean" == typeof t && (n = t, t = !1), t || (v.createHTMLDocument ? ((i = (t = T.implementation.createHTMLDocument("")).createElement("base")).href = T.location.href, t.head.appendChild(i)) : t = T), r = !n && [], (o = $.exec(e)) ? [t.createElement(o[1])] : (o = ve([e], t, r), r && r.length && C(r).remove(), C.merge([], o.childNodes)));
        var i, o, r
    }, C.fn.load = function(e, t, n) {
        var i, o, r, s = this,
            a = e.indexOf(" ");
        return -1 < a && (i = ft(e.slice(a)), e = e.slice(0, a)), y(t) ? (n = t, t = void 0) : t && "object" == typeof t && (o = "POST"), 0 < s.length && C.ajax({
            url: e,
            type: o || "GET",
            dataType: "html",
            data: t
        }).done(function(e) {
            r = arguments, s.html(i ? C("<div>").append(C.parseHTML(e)).find(i) : e)
        }).always(n && function(e, t) {
            s.each(function() {
                n.apply(this, r || [e.responseText, t, e])
            })
        }), this
    }, C.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(e, t) {
        C.fn[t] = function(e) {
            return this.on(t, e)
        }
    }), C.expr.pseudos.animated = function(t) {
        return C.grep(C.timers, function(e) {
            return t === e.elem
        }).length
    }, C.offset = {
        setOffset: function(e, t, n) {
            var i, o, r, s, a, l, c = C.css(e, "position"),
                u = C(e),
                d = {};
            "static" === c && (e.style.position = "relative"), a = u.offset(), r = C.css(e, "top"), l = C.css(e, "left"), ("absolute" === c || "fixed" === c) && -1 < (r + l).indexOf("auto") ? (s = (i = u.position()).top, o = i.left) : (s = parseFloat(r) || 0, o = parseFloat(l) || 0), y(t) && (t = t.call(e, n, C.extend({}, a))), null != t.top && (d.top = t.top - a.top + s), null != t.left && (d.left = t.left - a.left + o), "using" in t ? t.using.call(e, d) : u.css(d)
        }
    }, C.fn.extend({
        offset: function(t) {
            if (arguments.length) return void 0 === t ? this : this.each(function(e) {
                C.offset.setOffset(this, t, e)
            });
            var e, n, i = this[0];
            return i ? i.getClientRects().length ? (e = i.getBoundingClientRect(), n = i.ownerDocument.defaultView, {
                top: e.top + n.pageYOffset,
                left: e.left + n.pageXOffset
            }) : {
                top: 0,
                left: 0
            } : void 0
        },
        position: function() {
            if (this[0]) {
                var e, t, n, i = this[0],
                    o = {
                        top: 0,
                        left: 0
                    };
                if ("fixed" === C.css(i, "position")) t = i.getBoundingClientRect();
                else {
                    for (t = this.offset(), n = i.ownerDocument, e = i.offsetParent || n.documentElement; e && (e === n.body || e === n.documentElement) && "static" === C.css(e, "position");) e = e.parentNode;
                    e && e !== i && 1 === e.nodeType && ((o = C(e).offset()).top += C.css(e, "borderTopWidth", !0), o.left += C.css(e, "borderLeftWidth", !0))
                }
                return {
                    top: t.top - o.top - C.css(i, "marginTop", !0),
                    left: t.left - o.left - C.css(i, "marginLeft", !0)
                }
            }
        },
        offsetParent: function() {
            return this.map(function() {
                for (var e = this.offsetParent; e && "static" === C.css(e, "position");) e = e.offsetParent;
                return e || ye
            })
        }
    }), C.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function(t, o) {
        var r = "pageYOffset" === o;
        C.fn[t] = function(e) {
            return W(this, function(e, t, n) {
                var i;
                if (b(e) ? i = e : 9 === e.nodeType && (i = e.defaultView), void 0 === n) return i ? i[o] : e[t];
                i ? i.scrollTo(r ? i.pageXOffset : n, r ? n : i.pageYOffset) : e[t] = n
            }, t, e, arguments.length)
        }
    }), C.each(["top", "left"], function(e, n) {
        C.cssHooks[n] = _e(v.pixelPosition, function(e, t) {
            if (t) return t = Fe(e, n), Me.test(t) ? C(e).position()[n] + "px" : t
        })
    }), C.each({
        Height: "height",
        Width: "width"
    }, function(s, a) {
        C.each({
            padding: "inner" + s,
            content: a,
            "": "outer" + s
        }, function(i, r) {
            C.fn[r] = function(e, t) {
                var n = arguments.length && (i || "boolean" != typeof e),
                    o = i || (!0 === e || !0 === t ? "margin" : "border");
                return W(this, function(e, t, n) {
                    var i;
                    return b(e) ? 0 === r.indexOf("outer") ? e["inner" + s] : e.document.documentElement["client" + s] : 9 === e.nodeType ? (i = e.documentElement, Math.max(e.body["scroll" + s], i["scroll" + s], e.body["offset" + s], i["offset" + s], i["client" + s])) : void 0 === n ? C.css(e, t, o) : C.style(e, t, n, o)
                }, a, n ? e : void 0, n)
            }
        })
    }), C.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function(e, n) {
        C.fn[n] = function(e, t) {
            return 0 < arguments.length ? this.on(n, null, e, t) : this.trigger(n)
        }
    }), C.fn.extend({
        hover: function(e, t) {
            return this.mouseenter(e).mouseleave(t || e)
        }
    }), C.fn.extend({
        bind: function(e, t, n) {
            return this.on(e, null, t, n)
        },
        unbind: function(e, t) {
            return this.off(e, null, t)
        },
        delegate: function(e, t, n, i) {
            return this.on(t, e, n, i)
        },
        undelegate: function(e, t, n) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
        }
    }), C.proxy = function(e, t) {
        var n, i, o;
        if ("string" == typeof t && (n = e[t], t = e, e = n), y(e)) return i = a.call(arguments, 2), (o = function() {
            return e.apply(t || this, i.concat(a.call(arguments)))
        }).guid = e.guid = e.guid || C.guid++, o
    }, C.holdReady = function(e) {
        e ? C.readyWait++ : C.ready(!0)
    }, C.isArray = Array.isArray, C.parseJSON = JSON.parse, C.nodeName = A, C.isFunction = y, C.isWindow = b, C.camelCase = V, C.type = x, C.now = Date.now, C.isNumeric = function(e) {
        var t = C.type(e);
        return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e))
    }, "function" == typeof define && define.amd && define("jquery", [], function() {
        return C
    });
    var Bt = S.jQuery,
        Vt = S.$;
    return C.noConflict = function(e) {
        return S.$ === C && (S.$ = Vt), e && S.jQuery === C && (S.jQuery = Bt), C
    }, e || (S.jQuery = S.$ = C), C
}),
function(e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : "undefined" != typeof exports ? module.exports = e(require("jquery")) : e(jQuery)
}(function(c) {
    "use strict";
    var o, s = window.Slick || {};
    (o = 0, s = function(e, t) {
        var n, i = this;
        i.defaults = {
            accessibility: !0,
            adaptiveHeight: !1,
            appendArrows: c(e),
            appendDots: c(e),
            arrows: !0,
            asNavFor: null,
            prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
            nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
            autoplay: !1,
            autoplaySpeed: 3e3,
            centerMode: !1,
            centerPadding: "50px",
            cssEase: "ease",
            customPaging: function(e, t) {
                return c('<button type="button" />').text(t + 1)
            },
            dots: !1,
            dotsClass: "slick-dots",
            draggable: !0,
            easing: "linear",
            edgeFriction: .35,
            fade: !1,
            focusOnSelect: !1,
            focusOnChange: !1,
            infinite: !0,
            initialSlide: 0,
            lazyLoad: "ondemand",
            mobileFirst: !1,
            pauseOnHover: !0,
            pauseOnFocus: !0,
            pauseOnDotsHover: !1,
            respondTo: "window",
            responsive: null,
            rows: 1,
            rtl: !1,
            slide: "",
            slidesPerRow: 1,
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 500,
            swipe: !0,
            swipeToSlide: !1,
            touchMove: !0,
            touchThreshold: 5,
            useCSS: !0,
            useTransform: !0,
            variableWidth: !1,
            vertical: !1,
            verticalSwiping: !1,
            waitForAnimate: !0,
            zIndex: 1e3
        }, i.initials = {
            animating: !1,
            dragging: !1,
            autoPlayTimer: null,
            currentDirection: 0,
            currentLeft: null,
            currentSlide: 0,
            direction: 1,
            $dots: null,
            listWidth: null,
            listHeight: null,
            loadIndex: 0,
            $nextArrow: null,
            $prevArrow: null,
            scrolling: !1,
            slideCount: null,
            slideWidth: null,
            $slideTrack: null,
            $slides: null,
            sliding: !1,
            slideOffset: 0,
            swipeLeft: null,
            swiping: !1,
            $list: null,
            touchObject: {},
            transformsEnabled: !1,
            unslicked: !1
        }, c.extend(i, i.initials), i.activeBreakpoint = null, i.animType = null, i.animProp = null, i.breakpoints = [], i.breakpointSettings = [], i.cssTransitions = !1, i.focussed = !1, i.interrupted = !1, i.hidden = "hidden", i.paused = !0, i.positionProp = null, i.respondTo = null, i.rowCount = 1, i.shouldClick = !0, i.$slider = c(e), i.$slidesCache = null, i.transformType = null, i.transitionType = null, i.visibilityChange = "visibilitychange", i.windowWidth = 0, i.windowTimer = null, n = c(e).data("slick") || {}, i.options = c.extend({}, i.defaults, t, n), i.currentSlide = i.options.initialSlide, i.originalSettings = i.options, void 0 !== document.mozHidden ? (i.hidden = "mozHidden", i.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (i.hidden = "webkitHidden", i.visibilityChange = "webkitvisibilitychange"), i.autoPlay = c.proxy(i.autoPlay, i), i.autoPlayClear = c.proxy(i.autoPlayClear, i), i.autoPlayIterator = c.proxy(i.autoPlayIterator, i), i.changeSlide = c.proxy(i.changeSlide, i), i.clickHandler = c.proxy(i.clickHandler, i), i.selectHandler = c.proxy(i.selectHandler, i), i.setPosition = c.proxy(i.setPosition, i), i.swipeHandler = c.proxy(i.swipeHandler, i), i.dragHandler = c.proxy(i.dragHandler, i), i.keyHandler = c.proxy(i.keyHandler, i), i.instanceUid = o++, i.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, i.registerBreakpoints(), i.init(!0)
    }).prototype.activateADA = function() {
        this.$slideTrack.find(".slick-active").attr({
            "aria-hidden": "false"
        }).find("a, input, button, select").attr({
            tabindex: "0"
        })
    }, s.prototype.addSlide = s.prototype.slickAdd = function(e, t, n) {
        var i = this;
        if ("boolean" == typeof t) n = t, t = null;
        else if (t < 0 || t >= i.slideCount) return !1;
        i.unload(), "number" == typeof t ? 0 === t && 0 === i.$slides.length ? c(e).appendTo(i.$slideTrack) : n ? c(e).insertBefore(i.$slides.eq(t)) : c(e).insertAfter(i.$slides.eq(t)) : !0 === n ? c(e).prependTo(i.$slideTrack) : c(e).appendTo(i.$slideTrack), i.$slides = i.$slideTrack.children(this.options.slide), i.$slideTrack.children(this.options.slide).detach(), i.$slideTrack.append(i.$slides), i.$slides.each(function(e, t) {
            c(t).attr("data-slick-index", e)
        }), i.$slidesCache = i.$slides, i.reinit()
    }, s.prototype.animateHeight = function() {
        var e = this;
        if (1 === e.options.slidesToShow && !0 === e.options.adaptiveHeight && !1 === e.options.vertical) {
            var t = e.$slides.eq(e.currentSlide).outerHeight(!0);
            e.$list.animate({
                height: t
            }, e.options.speed)
        }
    }, s.prototype.animateSlide = function(e, t) {
        var n = {},
            i = this;
        i.animateHeight(), !0 === i.options.rtl && !1 === i.options.vertical && (e = -e), !1 === i.transformsEnabled ? !1 === i.options.vertical ? i.$slideTrack.animate({
            left: e
        }, i.options.speed, i.options.easing, t) : i.$slideTrack.animate({
            top: e
        }, i.options.speed, i.options.easing, t) : !1 === i.cssTransitions ? (!0 === i.options.rtl && (i.currentLeft = -i.currentLeft), c({
            animStart: i.currentLeft
        }).animate({
            animStart: e
        }, {
            duration: i.options.speed,
            easing: i.options.easing,
            step: function(e) {
                e = Math.ceil(e), !1 === i.options.vertical ? n[i.animType] = "translate(" + e + "px, 0px)" : n[i.animType] = "translate(0px," + e + "px)", i.$slideTrack.css(n)
            },
            complete: function() {
                t && t.call()
            }
        })) : (i.applyTransition(), e = Math.ceil(e), !1 === i.options.vertical ? n[i.animType] = "translate3d(" + e + "px, 0px, 0px)" : n[i.animType] = "translate3d(0px," + e + "px, 0px)", i.$slideTrack.css(n), t && setTimeout(function() {
            i.disableTransition(), t.call()
        }, i.options.speed))
    }, s.prototype.getNavTarget = function() {
        var e = this.options.asNavFor;
        return e && null !== e && (e = c(e).not(this.$slider)), e
    }, s.prototype.asNavFor = function(t) {
        var e = this.getNavTarget();
        null !== e && "object" == typeof e && e.each(function() {
            var e = c(this).slick("getSlick");
            e.unslicked || e.slideHandler(t, !0)
        })
    }, s.prototype.applyTransition = function(e) {
        var t = this,
            n = {};
        !1 === t.options.fade ? n[t.transitionType] = t.transformType + " " + t.options.speed + "ms " + t.options.cssEase : n[t.transitionType] = "opacity " + t.options.speed + "ms " + t.options.cssEase, !1 === t.options.fade ? t.$slideTrack.css(n) : t.$slides.eq(e).css(n)
    }, s.prototype.autoPlay = function() {
        var e = this;
        e.autoPlayClear(), e.slideCount > e.options.slidesToShow && (e.autoPlayTimer = setInterval(e.autoPlayIterator, e.options.autoplaySpeed))
    }, s.prototype.autoPlayClear = function() {
        this.autoPlayTimer && clearInterval(this.autoPlayTimer)
    }, s.prototype.autoPlayIterator = function() {
        var e = this,
            t = e.currentSlide + e.options.slidesToScroll;
        e.paused || e.interrupted || e.focussed || (!1 === e.options.infinite && (1 === e.direction && e.currentSlide + 1 === e.slideCount - 1 ? e.direction = 0 : 0 === e.direction && (t = e.currentSlide - e.options.slidesToScroll, e.currentSlide - 1 == 0 && (e.direction = 1))), e.slideHandler(t))
    }, s.prototype.buildArrows = function() {
        var e = this;
        !0 === e.options.arrows && (e.$prevArrow = c(e.options.prevArrow).addClass("slick-arrow"), e.$nextArrow = c(e.options.nextArrow).addClass("slick-arrow"), e.slideCount > e.options.slidesToShow ? (e.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.prependTo(e.options.appendArrows), e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.appendTo(e.options.appendArrows), !0 !== e.options.infinite && e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : e.$prevArrow.add(e.$nextArrow).addClass("slick-hidden").attr({
            "aria-disabled": "true",
            tabindex: "-1"
        }))
    }, s.prototype.buildDots = function() {
        var e, t, n = this;
        if (!0 === n.options.dots) {
            for (n.$slider.addClass("slick-dotted"), t = c("<ul />").addClass(n.options.dotsClass), e = 0; e <= n.getDotCount(); e += 1) t.append(c("<li />").append(n.options.customPaging.call(this, n, e)));
            n.$dots = t.appendTo(n.options.appendDots), n.$dots.find("li").first().addClass("slick-active")
        }
    }, s.prototype.buildOut = function() {
        var e = this;
        e.$slides = e.$slider.children(e.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), e.slideCount = e.$slides.length, e.$slides.each(function(e, t) {
            c(t).attr("data-slick-index", e).data("originalStyling", c(t).attr("style") || "")
        }), e.$slider.addClass("slick-slider"), e.$slideTrack = 0 === e.slideCount ? c('<div class="slick-track"/>').appendTo(e.$slider) : e.$slides.wrapAll('<div class="slick-track"/>').parent(), e.$list = e.$slideTrack.wrap('<div class="slick-list"/>').parent(), e.$slideTrack.css("opacity", 0), !0 !== e.options.centerMode && !0 !== e.options.swipeToSlide || (e.options.slidesToScroll = 1), c("img[data-lazy]", e.$slider).not("[src]").addClass("slick-loading"), e.setupInfinite(), e.buildArrows(), e.buildDots(), e.updateDots(), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), !0 === e.options.draggable && e.$list.addClass("draggable")
    }, s.prototype.buildRows = function() {
        var e, t, n, i, o, r, s, a = this;
        if (i = document.createDocumentFragment(), r = a.$slider.children(), 1 < a.options.rows) {
            for (s = a.options.slidesPerRow * a.options.rows, o = Math.ceil(r.length / s), e = 0; e < o; e++) {
                var l = document.createElement("div");
                for (t = 0; t < a.options.rows; t++) {
                    var c = document.createElement("div");
                    for (n = 0; n < a.options.slidesPerRow; n++) {
                        var u = e * s + (t * a.options.slidesPerRow + n);
                        r.get(u) && c.appendChild(r.get(u))
                    }
                    l.appendChild(c)
                }
                i.appendChild(l)
            }
            a.$slider.empty().append(i), a.$slider.children().children().children().css({
                width: 100 / a.options.slidesPerRow + "%",
                display: "inline-block"
            })
        }
    }, s.prototype.checkResponsive = function(e, t) {
        var n, i, o, r = this,
            s = !1,
            a = r.$slider.width(),
            l = window.innerWidth || c(window).width();
        if ("window" === r.respondTo ? o = l : "slider" === r.respondTo ? o = a : "min" === r.respondTo && (o = Math.min(l, a)), r.options.responsive && r.options.responsive.length && null !== r.options.responsive) {
            for (n in i = null, r.breakpoints) r.breakpoints.hasOwnProperty(n) && (!1 === r.originalSettings.mobileFirst ? o < r.breakpoints[n] && (i = r.breakpoints[n]) : o > r.breakpoints[n] && (i = r.breakpoints[n]));
            null !== i ? null !== r.activeBreakpoint ? (i !== r.activeBreakpoint || t) && (r.activeBreakpoint = i, "unslick" === r.breakpointSettings[i] ? r.unslick(i) : (r.options = c.extend({}, r.originalSettings, r.breakpointSettings[i]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), s = i) : (r.activeBreakpoint = i, "unslick" === r.breakpointSettings[i] ? r.unslick(i) : (r.options = c.extend({}, r.originalSettings, r.breakpointSettings[i]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), s = i) : null !== r.activeBreakpoint && (r.activeBreakpoint = null, r.options = r.originalSettings, !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e), s = i), e || !1 === s || r.$slider.trigger("breakpoint", [r, s])
        }
    }, s.prototype.changeSlide = function(e, t) {
        var n, i, o = this,
            r = c(e.currentTarget);
        switch (r.is("a") && e.preventDefault(), r.is("li") || (r = r.closest("li")), n = o.slideCount % o.options.slidesToScroll != 0 ? 0 : (o.slideCount - o.currentSlide) % o.options.slidesToScroll, e.data.message) {
            case "previous":
                i = 0 === n ? o.options.slidesToScroll : o.options.slidesToShow - n, o.slideCount > o.options.slidesToShow && o.slideHandler(o.currentSlide - i, !1, t);
                break;
            case "next":
                i = 0 === n ? o.options.slidesToScroll : n, o.slideCount > o.options.slidesToShow && o.slideHandler(o.currentSlide + i, !1, t);
                break;
            case "index":
                var s = 0 === e.data.index ? 0 : e.data.index || r.index() * o.options.slidesToScroll;
                o.slideHandler(o.checkNavigable(s), !1, t), r.children().trigger("focus");
                break;
            default:
                return
        }
    }, s.prototype.checkNavigable = function(e) {
        var t, n;
        if (n = 0, e > (t = this.getNavigableIndexes())[t.length - 1]) e = t[t.length - 1];
        else
            for (var i in t) {
                if (e < t[i]) {
                    e = n;
                    break
                }
                n = t[i]
            }
        return e
    }, s.prototype.cleanUpEvents = function() {
        var e = this;
        e.options.dots && null !== e.$dots && (c("li", e.$dots).off("click.slick", e.changeSlide).off("mouseenter.slick", c.proxy(e.interrupt, e, !0)).off("mouseleave.slick", c.proxy(e.interrupt, e, !1)), !0 === e.options.accessibility && e.$dots.off("keydown.slick", e.keyHandler)), e.$slider.off("focus.slick blur.slick"), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow && e.$prevArrow.off("click.slick", e.changeSlide), e.$nextArrow && e.$nextArrow.off("click.slick", e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow && e.$prevArrow.off("keydown.slick", e.keyHandler), e.$nextArrow && e.$nextArrow.off("keydown.slick", e.keyHandler))), e.$list.off("touchstart.slick mousedown.slick", e.swipeHandler), e.$list.off("touchmove.slick mousemove.slick", e.swipeHandler), e.$list.off("touchend.slick mouseup.slick", e.swipeHandler), e.$list.off("touchcancel.slick mouseleave.slick", e.swipeHandler), e.$list.off("click.slick", e.clickHandler), c(document).off(e.visibilityChange, e.visibility), e.cleanUpSlideEvents(), !0 === e.options.accessibility && e.$list.off("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && c(e.$slideTrack).children().off("click.slick", e.selectHandler), c(window).off("orientationchange.slick.slick-" + e.instanceUid, e.orientationChange), c(window).off("resize.slick.slick-" + e.instanceUid, e.resize), c("[draggable!=true]", e.$slideTrack).off("dragstart", e.preventDefault), c(window).off("load.slick.slick-" + e.instanceUid, e.setPosition)
    }, s.prototype.cleanUpSlideEvents = function() {
        var e = this;
        e.$list.off("mouseenter.slick", c.proxy(e.interrupt, e, !0)), e.$list.off("mouseleave.slick", c.proxy(e.interrupt, e, !1))
    }, s.prototype.cleanUpRows = function() {
        var e;
        1 < this.options.rows && ((e = this.$slides.children().children()).removeAttr("style"), this.$slider.empty().append(e))
    }, s.prototype.clickHandler = function(e) {
        !1 === this.shouldClick && (e.stopImmediatePropagation(), e.stopPropagation(), e.preventDefault())
    }, s.prototype.destroy = function(e) {
        var t = this;
        t.autoPlayClear(), t.touchObject = {}, t.cleanUpEvents(), c(".slick-cloned", t.$slider).detach(), t.$dots && t.$dots.remove(), t.$prevArrow && t.$prevArrow.length && (t.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.remove()), t.$nextArrow && t.$nextArrow.length && (t.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.remove()), t.$slides && (t.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function() {
            c(this).attr("style", c(this).data("originalStyling"))
        }), t.$slideTrack.children(this.options.slide).detach(), t.$slideTrack.detach(), t.$list.detach(), t.$slider.append(t.$slides)), t.cleanUpRows(), t.$slider.removeClass("slick-slider"), t.$slider.removeClass("slick-initialized"), t.$slider.removeClass("slick-dotted"), t.unslicked = !0, e || t.$slider.trigger("destroy", [t])
    }, s.prototype.disableTransition = function(e) {
        var t = {};
        t[this.transitionType] = "", !1 === this.options.fade ? this.$slideTrack.css(t) : this.$slides.eq(e).css(t)
    }, s.prototype.fadeSlide = function(e, t) {
        var n = this;
        !1 === n.cssTransitions ? (n.$slides.eq(e).css({
            zIndex: n.options.zIndex
        }), n.$slides.eq(e).animate({
            opacity: 1
        }, n.options.speed, n.options.easing, t)) : (n.applyTransition(e), n.$slides.eq(e).css({
            opacity: 1,
            zIndex: n.options.zIndex
        }), t && setTimeout(function() {
            n.disableTransition(e), t.call()
        }, n.options.speed))
    }, s.prototype.fadeSlideOut = function(e) {
        var t = this;
        !1 === t.cssTransitions ? t.$slides.eq(e).animate({
            opacity: 0,
            zIndex: t.options.zIndex - 2
        }, t.options.speed, t.options.easing) : (t.applyTransition(e), t.$slides.eq(e).css({
            opacity: 0,
            zIndex: t.options.zIndex - 2
        }))
    }, s.prototype.filterSlides = s.prototype.slickFilter = function(e) {
        var t = this;
        null !== e && (t.$slidesCache = t.$slides, t.unload(), t.$slideTrack.children(this.options.slide).detach(), t.$slidesCache.filter(e).appendTo(t.$slideTrack), t.reinit())
    }, s.prototype.focusHandler = function() {
        var n = this;
        n.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick", "*", function(e) {
            e.stopImmediatePropagation();
            var t = c(this);
            setTimeout(function() {
                n.options.pauseOnFocus && (n.focussed = t.is(":focus"), n.autoPlay())
            }, 0)
        })
    }, s.prototype.getCurrent = s.prototype.slickCurrentSlide = function() {
        return this.currentSlide
    }, s.prototype.getDotCount = function() {
        var e = this,
            t = 0,
            n = 0,
            i = 0;
        if (!0 === e.options.infinite)
            if (e.slideCount <= e.options.slidesToShow) ++i;
            else
                for (; t < e.slideCount;) ++i, t = n + e.options.slidesToScroll, n += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
        else if (!0 === e.options.centerMode) i = e.slideCount;
        else if (e.options.asNavFor)
            for (; t < e.slideCount;) ++i, t = n + e.options.slidesToScroll, n += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
        else i = 1 + Math.ceil((e.slideCount - e.options.slidesToShow) / e.options.slidesToScroll);
        return i - 1
    }, s.prototype.getLeft = function(e) {
        var t, n, i, o, r = this,
            s = 0;
        return r.slideOffset = 0, n = r.$slides.first().outerHeight(!0), !0 === r.options.infinite ? (r.slideCount > r.options.slidesToShow && (r.slideOffset = r.slideWidth * r.options.slidesToShow * -1, o = -1, !0 === r.options.vertical && !0 === r.options.centerMode && (2 === r.options.slidesToShow ? o = -1.5 : 1 === r.options.slidesToShow && (o = -2)), s = n * r.options.slidesToShow * o), r.slideCount % r.options.slidesToScroll != 0 && e + r.options.slidesToScroll > r.slideCount && r.slideCount > r.options.slidesToShow && (e > r.slideCount ? (r.slideOffset = (r.options.slidesToShow - (e - r.slideCount)) * r.slideWidth * -1, s = (r.options.slidesToShow - (e - r.slideCount)) * n * -1) : (r.slideOffset = r.slideCount % r.options.slidesToScroll * r.slideWidth * -1, s = r.slideCount % r.options.slidesToScroll * n * -1))) : e + r.options.slidesToShow > r.slideCount && (r.slideOffset = (e + r.options.slidesToShow - r.slideCount) * r.slideWidth, s = (e + r.options.slidesToShow - r.slideCount) * n), r.slideCount <= r.options.slidesToShow && (s = r.slideOffset = 0), !0 === r.options.centerMode && r.slideCount <= r.options.slidesToShow ? r.slideOffset = r.slideWidth * Math.floor(r.options.slidesToShow) / 2 - r.slideWidth * r.slideCount / 2 : !0 === r.options.centerMode && !0 === r.options.infinite ? r.slideOffset += r.slideWidth * Math.floor(r.options.slidesToShow / 2) - r.slideWidth : !0 === r.options.centerMode && (r.slideOffset = 0, r.slideOffset += r.slideWidth * Math.floor(r.options.slidesToShow / 2)), t = !1 === r.options.vertical ? e * r.slideWidth * -1 + r.slideOffset : e * n * -1 + s, !0 === r.options.variableWidth && (i = r.slideCount <= r.options.slidesToShow || !1 === r.options.infinite ? r.$slideTrack.children(".slick-slide").eq(e) : r.$slideTrack.children(".slick-slide").eq(e + r.options.slidesToShow), t = !0 === r.options.rtl ? i[0] ? -1 * (r.$slideTrack.width() - i[0].offsetLeft - i.width()) : 0 : i[0] ? -1 * i[0].offsetLeft : 0, !0 === r.options.centerMode && (i = r.slideCount <= r.options.slidesToShow || !1 === r.options.infinite ? r.$slideTrack.children(".slick-slide").eq(e) : r.$slideTrack.children(".slick-slide").eq(e + r.options.slidesToShow + 1), t = !0 === r.options.rtl ? i[0] ? -1 * (r.$slideTrack.width() - i[0].offsetLeft - i.width()) : 0 : i[0] ? -1 * i[0].offsetLeft : 0, t += (r.$list.width() - i.outerWidth()) / 2)), t
    }, s.prototype.getOption = s.prototype.slickGetOption = function(e) {
        return this.options[e]
    }, s.prototype.getNavigableIndexes = function() {
        var e, t = this,
            n = 0,
            i = 0,
            o = [];
        for (!1 === t.options.infinite ? e = t.slideCount : (n = -1 * t.options.slidesToScroll, i = -1 * t.options.slidesToScroll, e = 2 * t.slideCount); n < e;) o.push(n), n = i + t.options.slidesToScroll, i += t.options.slidesToScroll <= t.options.slidesToShow ? t.options.slidesToScroll : t.options.slidesToShow;
        return o
    }, s.prototype.getSlick = function() {
        return this
    }, s.prototype.getSlideCount = function() {
        var n, i, o = this;
        return i = !0 === o.options.centerMode ? o.slideWidth * Math.floor(o.options.slidesToShow / 2) : 0, !0 === o.options.swipeToSlide ? (o.$slideTrack.find(".slick-slide").each(function(e, t) {
            if (t.offsetLeft - i + c(t).outerWidth() / 2 > -1 * o.swipeLeft) return n = t, !1
        }), Math.abs(c(n).attr("data-slick-index") - o.currentSlide) || 1) : o.options.slidesToScroll
    }, s.prototype.goTo = s.prototype.slickGoTo = function(e, t) {
        this.changeSlide({
            data: {
                message: "index",
                index: parseInt(e)
            }
        }, t)
    }, s.prototype.init = function(e) {
        var t = this;
        c(t.$slider).hasClass("slick-initialized") || (c(t.$slider).addClass("slick-initialized"), t.buildRows(), t.buildOut(), t.setProps(), t.startLoad(), t.loadSlider(), t.initializeEvents(), t.updateArrows(), t.updateDots(), t.checkResponsive(!0), t.focusHandler()), e && t.$slider.trigger("init", [t]), !0 === t.options.accessibility && t.initADA(), t.options.autoplay && (t.paused = !1, t.autoPlay())
    }, s.prototype.initADA = function() {
        var n = this,
            i = Math.ceil(n.slideCount / n.options.slidesToShow),
            o = n.getNavigableIndexes().filter(function(e) {
                return 0 <= e && e < n.slideCount
            });
        n.$slides.add(n.$slideTrack.find(".slick-cloned")).attr({
            "aria-hidden": "true",
            tabindex: "-1"
        }).find("a, input, button, select").attr({
            tabindex: "-1"
        }), null !== n.$dots && (n.$slides.not(n.$slideTrack.find(".slick-cloned")).each(function(e) {
            var t = o.indexOf(e);
            c(this).attr({
                role: "tabpanel",
                id: "slick-slide" + n.instanceUid + e,
                tabindex: -1
            }), -1 !== t && c(this).attr({
                "aria-describedby": "slick-slide-control" + n.instanceUid + t
            })
        }), n.$dots.attr("role", "tablist").find("li").each(function(e) {
            var t = o[e];
            c(this).attr({
                role: "presentation"
            }), c(this).find("button").first().attr({
                role: "tab",
                id: "slick-slide-control" + n.instanceUid + e,
                "aria-controls": "slick-slide" + n.instanceUid + t,
                "aria-label": e + 1 + " of " + i,
                "aria-selected": null,
                tabindex: "-1"
            })
        }).eq(n.currentSlide).find("button").attr({
            "aria-selected": "true",
            tabindex: "0"
        }).end());
        for (var e = n.currentSlide, t = e + n.options.slidesToShow; e < t; e++) n.$slides.eq(e).attr("tabindex", 0);
        n.activateADA()
    }, s.prototype.initArrowEvents = function() {
        var e = this;
        !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.off("click.slick").on("click.slick", {
            message: "previous"
        }, e.changeSlide), e.$nextArrow.off("click.slick").on("click.slick", {
            message: "next"
        }, e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow.on("keydown.slick", e.keyHandler), e.$nextArrow.on("keydown.slick", e.keyHandler)))
    }, s.prototype.initDotEvents = function() {
        var e = this;
        !0 === e.options.dots && (c("li", e.$dots).on("click.slick", {
            message: "index"
        }, e.changeSlide), !0 === e.options.accessibility && e.$dots.on("keydown.slick", e.keyHandler)), !0 === e.options.dots && !0 === e.options.pauseOnDotsHover && c("li", e.$dots).on("mouseenter.slick", c.proxy(e.interrupt, e, !0)).on("mouseleave.slick", c.proxy(e.interrupt, e, !1))
    }, s.prototype.initSlideEvents = function() {
        var e = this;
        e.options.pauseOnHover && (e.$list.on("mouseenter.slick", c.proxy(e.interrupt, e, !0)), e.$list.on("mouseleave.slick", c.proxy(e.interrupt, e, !1)))
    }, s.prototype.initializeEvents = function() {
        var e = this;
        e.initArrowEvents(), e.initDotEvents(), e.initSlideEvents(), e.$list.on("touchstart.slick mousedown.slick", {
            action: "start"
        }, e.swipeHandler), e.$list.on("touchmove.slick mousemove.slick", {
            action: "move"
        }, e.swipeHandler), e.$list.on("touchend.slick mouseup.slick", {
            action: "end"
        }, e.swipeHandler), e.$list.on("touchcancel.slick mouseleave.slick", {
            action: "end"
        }, e.swipeHandler), e.$list.on("click.slick", e.clickHandler), c(document).on(e.visibilityChange, c.proxy(e.visibility, e)), !0 === e.options.accessibility && e.$list.on("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && c(e.$slideTrack).children().on("click.slick", e.selectHandler), c(window).on("orientationchange.slick.slick-" + e.instanceUid, c.proxy(e.orientationChange, e)), c(window).on("resize.slick.slick-" + e.instanceUid, c.proxy(e.resize, e)), c("[draggable!=true]", e.$slideTrack).on("dragstart", e.preventDefault), c(window).on("load.slick.slick-" + e.instanceUid, e.setPosition), c(e.setPosition)
    }, s.prototype.initUI = function() {
        var e = this;
        !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.show(), e.$nextArrow.show()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.show()
    }, s.prototype.keyHandler = function(e) {
        var t = this;
        e.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === e.keyCode && !0 === t.options.accessibility ? t.changeSlide({
            data: {
                message: !0 === t.options.rtl ? "next" : "previous"
            }
        }) : 39 === e.keyCode && !0 === t.options.accessibility && t.changeSlide({
            data: {
                message: !0 === t.options.rtl ? "previous" : "next"
            }
        }))
    }, s.prototype.lazyLoad = function() {
        function e(e) {
            c("img[data-lazy]", e).each(function() {
                var e = c(this),
                    t = c(this).attr("data-lazy"),
                    n = c(this).attr("data-srcset"),
                    i = c(this).attr("data-sizes") || r.$slider.attr("data-sizes"),
                    o = document.createElement("img");
                o.onload = function() {
                    e.animate({
                        opacity: 0
                    }, 100, function() {
                        n && (e.attr("srcset", n), i && e.attr("sizes", i)), e.attr("src", t).animate({
                            opacity: 1
                        }, 200, function() {
                            e.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading")
                        }), r.$slider.trigger("lazyLoaded", [r, e, t])
                    })
                }, o.onerror = function() {
                    e.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), r.$slider.trigger("lazyLoadError", [r, e, t])
                }, o.src = t
            })
        }
        var t, n, i, r = this;
        if (!0 === r.options.centerMode ? !0 === r.options.infinite ? i = (n = r.currentSlide + (r.options.slidesToShow / 2 + 1)) + r.options.slidesToShow + 2 : (n = Math.max(0, r.currentSlide - (r.options.slidesToShow / 2 + 1)), i = r.options.slidesToShow / 2 + 1 + 2 + r.currentSlide) : (n = r.options.infinite ? r.options.slidesToShow + r.currentSlide : r.currentSlide, i = Math.ceil(n + r.options.slidesToShow), !0 === r.options.fade && (0 < n && n--, i <= r.slideCount && i++)), t = r.$slider.find(".slick-slide").slice(n, i), "anticipated" === r.options.lazyLoad)
            for (var o = n - 1, s = i, a = r.$slider.find(".slick-slide"), l = 0; l < r.options.slidesToScroll; l++) o < 0 && (o = r.slideCount - 1), t = (t = t.add(a.eq(o))).add(a.eq(s)), o--, s++;
        e(t), r.slideCount <= r.options.slidesToShow ? e(r.$slider.find(".slick-slide")) : r.currentSlide >= r.slideCount - r.options.slidesToShow ? e(r.$slider.find(".slick-cloned").slice(0, r.options.slidesToShow)) : 0 === r.currentSlide && e(r.$slider.find(".slick-cloned").slice(-1 * r.options.slidesToShow))
    }, s.prototype.loadSlider = function() {
        var e = this;
        e.setPosition(), e.$slideTrack.css({
            opacity: 1
        }), e.$slider.removeClass("slick-loading"), e.initUI(), "progressive" === e.options.lazyLoad && e.progressiveLazyLoad()
    }, s.prototype.next = s.prototype.slickNext = function() {
        this.changeSlide({
            data: {
                message: "next"
            }
        })
    }, s.prototype.orientationChange = function() {
        this.checkResponsive(), this.setPosition()
    }, s.prototype.pause = s.prototype.slickPause = function() {
        this.autoPlayClear(), this.paused = !0
    }, s.prototype.play = s.prototype.slickPlay = function() {
        var e = this;
        e.autoPlay(), e.options.autoplay = !0, e.paused = !1, e.focussed = !1, e.interrupted = !1
    }, s.prototype.postSlide = function(e) {
        var t = this;
        t.unslicked || (t.$slider.trigger("afterChange", [t, e]), t.animating = !1, t.slideCount > t.options.slidesToShow && t.setPosition(), t.swipeLeft = null, t.options.autoplay && t.autoPlay(), !0 === t.options.accessibility && (t.initADA(), t.options.focusOnChange && c(t.$slides.get(t.currentSlide)).attr("tabindex", 0).focus()))
    }, s.prototype.prev = s.prototype.slickPrev = function() {
        this.changeSlide({
            data: {
                message: "previous"
            }
        })
    }, s.prototype.preventDefault = function(e) {
        e.preventDefault()
    }, s.prototype.progressiveLazyLoad = function(e) {
        e = e || 1;
        var t, n, i, o, r, s = this,
            a = c("img[data-lazy]", s.$slider);
        a.length ? (t = a.first(), n = t.attr("data-lazy"), i = t.attr("data-srcset"), o = t.attr("data-sizes") || s.$slider.attr("data-sizes"), (r = document.createElement("img")).onload = function() {
            i && (t.attr("srcset", i), o && t.attr("sizes", o)), t.attr("src", n).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading"), !0 === s.options.adaptiveHeight && s.setPosition(), s.$slider.trigger("lazyLoaded", [s, t, n]), s.progressiveLazyLoad()
        }, r.onerror = function() {
            e < 3 ? setTimeout(function() {
                s.progressiveLazyLoad(e + 1)
            }, 500) : (t.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), s.$slider.trigger("lazyLoadError", [s, t, n]), s.progressiveLazyLoad())
        }, r.src = n) : s.$slider.trigger("allImagesLoaded", [s])
    }, s.prototype.refresh = function(e) {
        var t, n, i = this;
        n = i.slideCount - i.options.slidesToShow, !i.options.infinite && i.currentSlide > n && (i.currentSlide = n), i.slideCount <= i.options.slidesToShow && (i.currentSlide = 0), t = i.currentSlide, i.destroy(!0), c.extend(i, i.initials, {
            currentSlide: t
        }), i.init(), e || i.changeSlide({
            data: {
                message: "index",
                index: t
            }
        }, !1)
    }, s.prototype.registerBreakpoints = function() {
        var e, t, n, i = this,
            o = i.options.responsive || null;
        if ("array" === c.type(o) && o.length) {
            for (e in i.respondTo = i.options.respondTo || "window", o)
                if (n = i.breakpoints.length - 1, o.hasOwnProperty(e)) {
                    for (t = o[e].breakpoint; 0 <= n;) i.breakpoints[n] && i.breakpoints[n] === t && i.breakpoints.splice(n, 1), n--;
                    i.breakpoints.push(t), i.breakpointSettings[t] = o[e].settings
                }
            i.breakpoints.sort(function(e, t) {
                return i.options.mobileFirst ? e - t : t - e
            })
        }
    }, s.prototype.reinit = function() {
        var e = this;
        e.$slides = e.$slideTrack.children(e.options.slide).addClass("slick-slide"), e.slideCount = e.$slides.length, e.currentSlide >= e.slideCount && 0 !== e.currentSlide && (e.currentSlide = e.currentSlide - e.options.slidesToScroll), e.slideCount <= e.options.slidesToShow && (e.currentSlide = 0), e.registerBreakpoints(), e.setProps(), e.setupInfinite(), e.buildArrows(), e.updateArrows(), e.initArrowEvents(), e.buildDots(), e.updateDots(), e.initDotEvents(), e.cleanUpSlideEvents(), e.initSlideEvents(), e.checkResponsive(!1, !0), !0 === e.options.focusOnSelect && c(e.$slideTrack).children().on("click.slick", e.selectHandler), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), e.setPosition(), e.focusHandler(), e.paused = !e.options.autoplay, e.autoPlay(), e.$slider.trigger("reInit", [e])
    }, s.prototype.resize = function() {
        var e = this;
        c(window).width() !== e.windowWidth && (clearTimeout(e.windowDelay), e.windowDelay = window.setTimeout(function() {
            e.windowWidth = c(window).width(), e.checkResponsive(), e.unslicked || e.setPosition()
        }, 50))
    }, s.prototype.removeSlide = s.prototype.slickRemove = function(e, t, n) {
        var i = this;
        if (e = "boolean" == typeof e ? !0 === (t = e) ? 0 : i.slideCount - 1 : !0 === t ? --e : e, i.slideCount < 1 || e < 0 || e > i.slideCount - 1) return !1;
        i.unload(), !0 === n ? i.$slideTrack.children().remove() : i.$slideTrack.children(this.options.slide).eq(e).remove(), i.$slides = i.$slideTrack.children(this.options.slide), i.$slideTrack.children(this.options.slide).detach(), i.$slideTrack.append(i.$slides), i.$slidesCache = i.$slides, i.reinit()
    }, s.prototype.setCSS = function(e) {
        var t, n, i = this,
            o = {};
        !0 === i.options.rtl && (e = -e), t = "left" == i.positionProp ? Math.ceil(e) + "px" : "0px", n = "top" == i.positionProp ? Math.ceil(e) + "px" : "0px", o[i.positionProp] = e, !1 === i.transformsEnabled || (!(o = {}) === i.cssTransitions ? o[i.animType] = "translate(" + t + ", " + n + ")" : o[i.animType] = "translate3d(" + t + ", " + n + ", 0px)"), i.$slideTrack.css(o)
    }, s.prototype.setDimensions = function() {
        var e = this;
        !1 === e.options.vertical ? !0 === e.options.centerMode && e.$list.css({
            padding: "0px " + e.options.centerPadding
        }) : (e.$list.height(e.$slides.first().outerHeight(!0) * e.options.slidesToShow), !0 === e.options.centerMode && e.$list.css({
            padding: e.options.centerPadding + " 0px"
        })), e.listWidth = e.$list.width(), e.listHeight = e.$list.height(), !1 === e.options.vertical && !1 === e.options.variableWidth ? (e.slideWidth = Math.ceil(e.listWidth / e.options.slidesToShow), e.$slideTrack.width(Math.ceil(e.slideWidth * e.$slideTrack.children(".slick-slide").length))) : !0 === e.options.variableWidth ? e.$slideTrack.width(5e3 * e.slideCount) : (e.slideWidth = Math.ceil(e.listWidth), e.$slideTrack.height(Math.ceil(e.$slides.first().outerHeight(!0) * e.$slideTrack.children(".slick-slide").length)));
        var t = e.$slides.first().outerWidth(!0) - e.$slides.first().width();
        !1 === e.options.variableWidth && e.$slideTrack.children(".slick-slide").width(e.slideWidth - t)
    }, s.prototype.setFade = function() {
        var n, i = this;
        i.$slides.each(function(e, t) {
            n = i.slideWidth * e * -1, !0 === i.options.rtl ? c(t).css({
                position: "relative",
                right: n,
                top: 0,
                zIndex: i.options.zIndex - 2,
                opacity: 0
            }) : c(t).css({
                position: "relative",
                left: n,
                top: 0,
                zIndex: i.options.zIndex - 2,
                opacity: 0
            })
        }), i.$slides.eq(i.currentSlide).css({
            zIndex: i.options.zIndex - 1,
            opacity: 1
        })
    }, s.prototype.setHeight = function() {
        var e = this;
        if (1 === e.options.slidesToShow && !0 === e.options.adaptiveHeight && !1 === e.options.vertical) {
            var t = e.$slides.eq(e.currentSlide).outerHeight(!0);
            e.$list.css("height", t)
        }
    }, s.prototype.setOption = s.prototype.slickSetOption = function() {
        var e, t, n, i, o, r = this,
            s = !1;
        if ("object" === c.type(arguments[0]) ? (n = arguments[0], s = arguments[1], o = "multiple") : "string" === c.type(arguments[0]) && (n = arguments[0], i = arguments[1], s = arguments[2], "responsive" === arguments[0] && "array" === c.type(arguments[1]) ? o = "responsive" : void 0 !== arguments[1] && (o = "single")), "single" === o) r.options[n] = i;
        else if ("multiple" === o) c.each(n, function(e, t) {
            r.options[e] = t
        });
        else if ("responsive" === o)
            for (t in i)
                if ("array" !== c.type(r.options.responsive)) r.options.responsive = [i[t]];
                else {
                    for (e = r.options.responsive.length - 1; 0 <= e;) r.options.responsive[e].breakpoint === i[t].breakpoint && r.options.responsive.splice(e, 1), e--;
                    r.options.responsive.push(i[t])
                }
        s && (r.unload(), r.reinit())
    }, s.prototype.setPosition = function() {
        var e = this;
        e.setDimensions(), e.setHeight(), !1 === e.options.fade ? e.setCSS(e.getLeft(e.currentSlide)) : e.setFade(), e.$slider.trigger("setPosition", [e])
    }, s.prototype.setProps = function() {
        var e = this,
            t = document.body.style;
        e.positionProp = !0 === e.options.vertical ? "top" : "left", "top" === e.positionProp ? e.$slider.addClass("slick-vertical") : e.$slider.removeClass("slick-vertical"), void 0 === t.WebkitTransition && void 0 === t.MozTransition && void 0 === t.msTransition || !0 === e.options.useCSS && (e.cssTransitions = !0), e.options.fade && ("number" == typeof e.options.zIndex ? e.options.zIndex < 3 && (e.options.zIndex = 3) : e.options.zIndex = e.defaults.zIndex), void 0 !== t.OTransform && (e.animType = "OTransform", e.transformType = "-o-transform", e.transitionType = "OTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (e.animType = !1)), void 0 !== t.MozTransform && (e.animType = "MozTransform", e.transformType = "-moz-transform", e.transitionType = "MozTransition", void 0 === t.perspectiveProperty && void 0 === t.MozPerspective && (e.animType = !1)), void 0 !== t.webkitTransform && (e.animType = "webkitTransform", e.transformType = "-webkit-transform", e.transitionType = "webkitTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (e.animType = !1)), void 0 !== t.msTransform && (e.animType = "msTransform", e.transformType = "-ms-transform", e.transitionType = "msTransition", void 0 === t.msTransform && (e.animType = !1)), void 0 !== t.transform && !1 !== e.animType && (e.animType = "transform", e.transformType = "transform", e.transitionType = "transition"), e.transformsEnabled = e.options.useTransform && null !== e.animType && !1 !== e.animType
    }, s.prototype.setSlideClasses = function(e) {
        var t, n, i, o, r = this;
        if (n = r.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), r.$slides.eq(e).addClass("slick-current"), !0 === r.options.centerMode) {
            var s = r.options.slidesToShow % 2 == 0 ? 1 : 0;
            t = Math.floor(r.options.slidesToShow / 2), !0 === r.options.infinite && (t <= e && e <= r.slideCount - 1 - t ? r.$slides.slice(e - t + s, e + t + 1).addClass("slick-active").attr("aria-hidden", "false") : (i = r.options.slidesToShow + e, n.slice(i - t + 1 + s, i + t + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === e ? n.eq(n.length - 1 - r.options.slidesToShow).addClass("slick-center") : e === r.slideCount - 1 && n.eq(r.options.slidesToShow).addClass("slick-center")), r.$slides.eq(e).addClass("slick-center")
        } else 0 <= e && e <= r.slideCount - r.options.slidesToShow ? r.$slides.slice(e, e + r.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : n.length <= r.options.slidesToShow ? n.addClass("slick-active").attr("aria-hidden", "false") : (o = r.slideCount % r.options.slidesToShow, i = !0 === r.options.infinite ? r.options.slidesToShow + e : e, r.options.slidesToShow == r.options.slidesToScroll && r.slideCount - e < r.options.slidesToShow ? n.slice(i - (r.options.slidesToShow - o), i + o).addClass("slick-active").attr("aria-hidden", "false") : n.slice(i, i + r.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false"));
        "ondemand" !== r.options.lazyLoad && "anticipated" !== r.options.lazyLoad || r.lazyLoad()
    }, s.prototype.setupInfinite = function() {
        var e, t, n, i = this;
        if (!0 === i.options.fade && (i.options.centerMode = !1), !0 === i.options.infinite && !1 === i.options.fade && (t = null, i.slideCount > i.options.slidesToShow)) {
            for (n = !0 === i.options.centerMode ? i.options.slidesToShow + 1 : i.options.slidesToShow, e = i.slideCount; e > i.slideCount - n; e -= 1) t = e - 1, c(i.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t - i.slideCount).prependTo(i.$slideTrack).addClass("slick-cloned");
            for (e = 0; e < n + i.slideCount; e += 1) t = e, c(i.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t + i.slideCount).appendTo(i.$slideTrack).addClass("slick-cloned");
            i.$slideTrack.find(".slick-cloned").find("[id]").each(function() {
                c(this).attr("id", "")
            })
        }
    }, s.prototype.interrupt = function(e) {
        e || this.autoPlay(), this.interrupted = e
    }, s.prototype.selectHandler = function(e) {
        var t = c(e.target).is(".slick-slide") ? c(e.target) : c(e.target).parents(".slick-slide"),
            n = parseInt(t.attr("data-slick-index"));
        n || (n = 0), this.slideCount <= this.options.slidesToShow ? this.slideHandler(n, !1, !0) : this.slideHandler(n)
    }, s.prototype.slideHandler = function(e, t, n) {
        var i, o, r, s, a, l = null,
            c = this;
        if (t = t || !1, !(!0 === c.animating && !0 === c.options.waitForAnimate || !0 === c.options.fade && c.currentSlide === e))
            if (!1 === t && c.asNavFor(e), i = e, l = c.getLeft(i), s = c.getLeft(c.currentSlide), c.currentLeft = null === c.swipeLeft ? s : c.swipeLeft, !1 === c.options.infinite && !1 === c.options.centerMode && (e < 0 || e > c.getDotCount() * c.options.slidesToScroll)) !1 === c.options.fade && (i = c.currentSlide, !0 !== n ? c.animateSlide(s, function() {
                c.postSlide(i)
            }) : c.postSlide(i));
            else if (!1 === c.options.infinite && !0 === c.options.centerMode && (e < 0 || e > c.slideCount - c.options.slidesToScroll)) !1 === c.options.fade && (i = c.currentSlide, !0 !== n ? c.animateSlide(s, function() {
            c.postSlide(i)
        }) : c.postSlide(i));
        else {
            if (c.options.autoplay && clearInterval(c.autoPlayTimer), o = i < 0 ? c.slideCount % c.options.slidesToScroll != 0 ? c.slideCount - c.slideCount % c.options.slidesToScroll : c.slideCount + i : i >= c.slideCount ? c.slideCount % c.options.slidesToScroll != 0 ? 0 : i - c.slideCount : i, c.animating = !0, c.$slider.trigger("beforeChange", [c, c.currentSlide, o]), r = c.currentSlide, c.currentSlide = o, c.setSlideClasses(c.currentSlide), c.options.asNavFor && (a = (a = c.getNavTarget()).slick("getSlick")).slideCount <= a.options.slidesToShow && a.setSlideClasses(c.currentSlide), c.updateDots(), c.updateArrows(), !0 === c.options.fade) return !0 !== n ? (c.fadeSlideOut(r), c.fadeSlide(o, function() {
                c.postSlide(o)
            })) : c.postSlide(o), void c.animateHeight();
            !0 !== n ? c.animateSlide(l, function() {
                c.postSlide(o)
            }) : c.postSlide(o)
        }
    }, s.prototype.startLoad = function() {
        var e = this;
        !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.hide(), e.$nextArrow.hide()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.hide(), e.$slider.addClass("slick-loading")
    }, s.prototype.swipeDirection = function() {
        var e, t, n, i, o = this;
        return e = o.touchObject.startX - o.touchObject.curX, t = o.touchObject.startY - o.touchObject.curY, n = Math.atan2(t, e), (i = Math.round(180 * n / Math.PI)) < 0 && (i = 360 - Math.abs(i)), i <= 45 && 0 <= i ? !1 === o.options.rtl ? "left" : "right" : i <= 360 && 315 <= i ? !1 === o.options.rtl ? "left" : "right" : 135 <= i && i <= 225 ? !1 === o.options.rtl ? "right" : "left" : !0 === o.options.verticalSwiping ? 35 <= i && i <= 135 ? "down" : "up" : "vertical"
    }, s.prototype.swipeEnd = function(e) {
        var t, n, i = this;
        if (i.dragging = !1, i.swiping = !1, i.scrolling) return i.scrolling = !1;
        if (i.interrupted = !1, i.shouldClick = !(10 < i.touchObject.swipeLength), void 0 === i.touchObject.curX) return !1;
        if (!0 === i.touchObject.edgeHit && i.$slider.trigger("edge", [i, i.swipeDirection()]), i.touchObject.swipeLength >= i.touchObject.minSwipe) {
            switch (n = i.swipeDirection()) {
                case "left":
                case "down":
                    t = i.options.swipeToSlide ? i.checkNavigable(i.currentSlide + i.getSlideCount()) : i.currentSlide + i.getSlideCount(), i.currentDirection = 0;
                    break;
                case "right":
                case "up":
                    t = i.options.swipeToSlide ? i.checkNavigable(i.currentSlide - i.getSlideCount()) : i.currentSlide - i.getSlideCount(), i.currentDirection = 1
            }
            "vertical" != n && (i.slideHandler(t), i.touchObject = {}, i.$slider.trigger("swipe", [i, n]))
        } else i.touchObject.startX !== i.touchObject.curX && (i.slideHandler(i.currentSlide), i.touchObject = {})
    }, s.prototype.swipeHandler = function(e) {
        var t = this;
        if (!(!1 === t.options.swipe || "ontouchend" in document && !1 === t.options.swipe || !1 === t.options.draggable && -1 !== e.type.indexOf("mouse"))) switch (t.touchObject.fingerCount = e.originalEvent && void 0 !== e.originalEvent.touches ? e.originalEvent.touches.length : 1, t.touchObject.minSwipe = t.listWidth / t.options.touchThreshold, !0 === t.options.verticalSwiping && (t.touchObject.minSwipe = t.listHeight / t.options.touchThreshold), e.data.action) {
            case "start":
                t.swipeStart(e);
                break;
            case "move":
                t.swipeMove(e);
                break;
            case "end":
                t.swipeEnd(e)
        }
    }, s.prototype.swipeMove = function(e) {
        var t, n, i, o, r, s, a = this;
        return r = void 0 !== e.originalEvent ? e.originalEvent.touches : null, !(!a.dragging || a.scrolling || r && 1 !== r.length) && (t = a.getLeft(a.currentSlide), a.touchObject.curX = void 0 !== r ? r[0].pageX : e.clientX, a.touchObject.curY = void 0 !== r ? r[0].pageY : e.clientY, a.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(a.touchObject.curX - a.touchObject.startX, 2))), s = Math.round(Math.sqrt(Math.pow(a.touchObject.curY - a.touchObject.startY, 2))), !a.options.verticalSwiping && !a.swiping && 4 < s ? !(a.scrolling = !0) : (!0 === a.options.verticalSwiping && (a.touchObject.swipeLength = s), n = a.swipeDirection(), void 0 !== e.originalEvent && 4 < a.touchObject.swipeLength && (a.swiping = !0, e.preventDefault()), o = (!1 === a.options.rtl ? 1 : -1) * (a.touchObject.curX > a.touchObject.startX ? 1 : -1), !0 === a.options.verticalSwiping && (o = a.touchObject.curY > a.touchObject.startY ? 1 : -1), i = a.touchObject.swipeLength, (a.touchObject.edgeHit = !1) === a.options.infinite && (0 === a.currentSlide && "right" === n || a.currentSlide >= a.getDotCount() && "left" === n) && (i = a.touchObject.swipeLength * a.options.edgeFriction, a.touchObject.edgeHit = !0), !1 === a.options.vertical ? a.swipeLeft = t + i * o : a.swipeLeft = t + i * (a.$list.height() / a.listWidth) * o, !0 === a.options.verticalSwiping && (a.swipeLeft = t + i * o), !0 !== a.options.fade && !1 !== a.options.touchMove && (!0 === a.animating ? (a.swipeLeft = null, !1) : void a.setCSS(a.swipeLeft))))
    }, s.prototype.swipeStart = function(e) {
        var t, n = this;
        if (n.interrupted = !0, 1 !== n.touchObject.fingerCount || n.slideCount <= n.options.slidesToShow) return !(n.touchObject = {});
        void 0 !== e.originalEvent && void 0 !== e.originalEvent.touches && (t = e.originalEvent.touches[0]), n.touchObject.startX = n.touchObject.curX = void 0 !== t ? t.pageX : e.clientX, n.touchObject.startY = n.touchObject.curY = void 0 !== t ? t.pageY : e.clientY, n.dragging = !0
    }, s.prototype.unfilterSlides = s.prototype.slickUnfilter = function() {
        var e = this;
        null !== e.$slidesCache && (e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.appendTo(e.$slideTrack), e.reinit())
    }, s.prototype.unload = function() {
        var e = this;
        c(".slick-cloned", e.$slider).remove(), e.$dots && e.$dots.remove(), e.$prevArrow && e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.remove(), e.$nextArrow && e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.remove(), e.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
    }, s.prototype.unslick = function(e) {
        this.$slider.trigger("unslick", [this, e]), this.destroy()
    }, s.prototype.updateArrows = function() {
        var e = this;
        Math.floor(e.options.slidesToShow / 2), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && !e.options.infinite && (e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === e.currentSlide ? (e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : e.currentSlide >= e.slideCount - e.options.slidesToShow && !1 === e.options.centerMode ? (e.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : e.currentSlide >= e.slideCount - 1 && !0 === e.options.centerMode && (e.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
    }, s.prototype.updateDots = function() {
        var e = this;
        null !== e.$dots && (e.$dots.find("li").removeClass("slick-active").end(), e.$dots.find("li").eq(Math.floor(e.currentSlide / e.options.slidesToScroll)).addClass("slick-active"))
    }, s.prototype.visibility = function() {
        this.options.autoplay && (document[this.hidden] ? this.interrupted = !0 : this.interrupted = !1)
    }, c.fn.slick = function() {
        var e, t, n = this,
            i = arguments[0],
            o = Array.prototype.slice.call(arguments, 1),
            r = n.length;
        for (e = 0; e < r; e++)
            if ("object" == typeof i || void 0 === i ? n[e].slick = new s(n[e], i) : t = n[e].slick[i].apply(n[e].slick, o), void 0 !== t) return t;
        return n
    }
}),
function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = t(require("jquery")) : "function" == typeof define && define.amd ? define(["jquery"], t) : e.Util = t(e.jQuery)
}(this, function(e) {
    "use strict";
    return function(i) {
        var t = "transitionend";

        function e(e) {
            var t = this,
                n = !1;
            return i(this).one(l.TRANSITION_END, function() {
                n = !0
            }), setTimeout(function() {
                n || l.triggerTransitionEnd(t)
            }, e), this
        }
        var l = {
            TRANSITION_END: "bsTransitionEnd",
            getUID: function(e) {
                for (; e += ~~(1e6 * Math.random()), document.getElementById(e););
                return e
            },
            getSelectorFromElement: function(e) {
                var t = e.getAttribute("data-target");
                t && "#" !== t || (t = e.getAttribute("href") || "");
                try {
                    return document.querySelector(t) ? t : null
                } catch (e) {
                    return null
                }
            },
            getTransitionDurationFromElement: function(e) {
                if (!e) return 0;
                var t = i(e).css("transition-duration");
                return parseFloat(t) ? (t = t.split(",")[0], 1e3 * parseFloat(t)) : 0
            },
            reflow: function(e) {
                return e.offsetHeight
            },
            triggerTransitionEnd: function(e) {
                i(e).trigger(t)
            },
            supportsTransitionEnd: function() {
                return Boolean(t)
            },
            isElement: function(e) {
                return (e[0] || e).nodeType
            },
            typeCheckConfig: function(e, t, n) {
                for (var i in n)
                    if (Object.prototype.hasOwnProperty.call(n, i)) {
                        var o = n[i],
                            r = t[i],
                            s = r && l.isElement(r) ? "element" : (a = r, {}.toString.call(a).match(/\s([a-z]+)/i)[1].toLowerCase());
                        if (!new RegExp(o).test(s)) throw new Error(e.toUpperCase() + ': Option "' + i + '" provided type "' + s + '" but expected type "' + o + '".')
                    }
                var a
            }
        };
        return i.fn.emulateTransitionEnd = e, i.event.special[l.TRANSITION_END] = {
            bindType: t,
            delegateType: t,
            handle: function(e) {
                if (i(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
            }
        }, l
    }(e = e && e.hasOwnProperty("default") ? e.default : e)
}),
function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : e.Popper = t()
}(this, function() {
    "use strict";

    function s(e) {
        return e && "[object Function]" === {}.toString.call(e)
    }

    function w(e, t) {
        if (1 !== e.nodeType) return [];
        var n = getComputedStyle(e, null);
        return t ? n[t] : n
    }

    function p(e) {
        return "HTML" === e.nodeName ? e : e.parentNode || e.host
    }

    function h(e) {
        if (!e) return document.body;
        switch (e.nodeName) {
            case "HTML":
            case "BODY":
                return e.ownerDocument.body;
            case "#document":
                return e.body
        }
        var t = w(e),
            n = t.overflow,
            i = t.overflowX,
            o = t.overflowY;
        return /(auto|scroll|overlay)/.test(n + o + i) ? e : h(p(e))
    }

    function g(e) {
        return 11 === e ? R : 10 === e ? U : R || U
    }

    function y(e) {
        if (!e) return document.documentElement;
        for (var t = g(10) ? document.body : null, n = e.offsetParent; n === t && e.nextElementSibling;) n = (e = e.nextElementSibling).offsetParent;
        var i = n && n.nodeName;
        return i && "BODY" !== i && "HTML" !== i ? -1 !== ["TD", "TABLE"].indexOf(n.nodeName) && "static" === w(n, "position") ? y(n) : n : e ? e.ownerDocument.documentElement : document.documentElement
    }

    function u(e) {
        return null === e.parentNode ? e : u(e.parentNode)
    }

    function f(e, t) {
        if (!(e && e.nodeType && t && t.nodeType)) return document.documentElement;
        var n = e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
            i = n ? e : t,
            o = n ? t : e,
            r = document.createRange();
        r.setStart(i, 0), r.setEnd(o, 0);
        var s, a, l = r.commonAncestorContainer;
        if (e !== l && t !== l || i.contains(o)) return "BODY" === (a = (s = l).nodeName) || "HTML" !== a && y(s.firstElementChild) !== s ? y(l) : l;
        var c = u(e);
        return c.host ? f(c.host, t) : f(e, u(t).host)
    }

    function m(e) {
        var t = "top" === (1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "top") ? "scrollTop" : "scrollLeft",
            n = e.nodeName;
        if ("BODY" === n || "HTML" === n) {
            var i = e.ownerDocument.documentElement;
            return (e.ownerDocument.scrollingElement || i)[t]
        }
        return e[t]
    }

    function d(e, t) {
        var n = "x" === t ? "Left" : "Top",
            i = "Left" == n ? "Right" : "Bottom";
        return parseFloat(e["border" + n + "Width"], 10) + parseFloat(e["border" + i + "Width"], 10)
    }

    function i(e, t, n, i) {
        return q(t["offset" + e], t["scroll" + e], n["client" + e], n["offset" + e], n["scroll" + e], g(10) ? n["offset" + e] + i["margin" + ("Height" === e ? "Top" : "Left")] + i["margin" + ("Height" === e ? "Bottom" : "Right")] : 0)
    }

    function v() {
        var e = document.body,
            t = document.documentElement,
            n = g(10) && getComputedStyle(t);
        return {
            height: i("Height", e, t, n),
            width: i("Width", e, t, n)
        }
    }

    function x(e) {
        return X({}, e, {
            right: e.left + e.width,
            bottom: e.top + e.height
        })
    }

    function b(e) {
        var t = {};
        try {
            if (g(10)) {
                t = e.getBoundingClientRect();
                var n = m(e, "top"),
                    i = m(e, "left");
                t.top += n, t.left += i, t.bottom += n, t.right += i
            } else t = e.getBoundingClientRect()
        } catch (e) {}
        var o = {
                left: t.left,
                top: t.top,
                width: t.right - t.left,
                height: t.bottom - t.top
            },
            r = "HTML" === e.nodeName ? v() : {},
            s = r.width || e.clientWidth || o.right - o.left,
            a = r.height || e.clientHeight || o.bottom - o.top,
            l = e.offsetWidth - s,
            c = e.offsetHeight - a;
        if (l || c) {
            var u = w(e);
            l -= d(u, "x"), c -= d(u, "y"), o.width -= l, o.height -= c
        }
        return x(o)
    }

    function k(e, t) {
        var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
            i = g(10),
            o = "HTML" === t.nodeName,
            r = b(e),
            s = b(t),
            a = h(e),
            l = w(t),
            c = parseFloat(l.borderTopWidth, 10),
            u = parseFloat(l.borderLeftWidth, 10);
        n && "HTML" === t.nodeName && (s.top = q(s.top, 0), s.left = q(s.left, 0));
        var d = x({
            top: r.top - s.top - c,
            left: r.left - s.left - u,
            width: r.width,
            height: r.height
        });
        if (d.marginTop = 0, d.marginLeft = 0, !i && o) {
            var p = parseFloat(l.marginTop, 10),
                f = parseFloat(l.marginLeft, 10);
            d.top -= c - p, d.bottom -= c - p, d.left -= u - f, d.right -= u - f, d.marginTop = p, d.marginLeft = f
        }
        return (i && !n ? t.contains(a) : t === a && "BODY" !== a.nodeName) && (d = function(e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
                i = m(t, "top"),
                o = m(t, "left"),
                r = n ? -1 : 1;
            return e.top += i * r, e.bottom += i * r, e.left += o * r, e.right += o * r, e
        }(d, t)), d
    }

    function S(e) {
        if (!e || !e.parentElement || g()) return document.documentElement;
        for (var t = e.parentElement; t && "none" === w(t, "transform");) t = t.parentElement;
        return t || document.documentElement
    }

    function T(e, t, n, i) {
        var o = 4 < arguments.length && void 0 !== arguments[4] && arguments[4],
            r = {
                top: 0,
                left: 0
            },
            s = o ? S(e) : f(e, t);
        if ("viewport" === i) r = function(e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
                n = e.ownerDocument.documentElement,
                i = k(e, n),
                o = q(n.clientWidth, window.innerWidth || 0),
                r = q(n.clientHeight, window.innerHeight || 0),
                s = t ? 0 : m(n),
                a = t ? 0 : m(n, "left");
            return x({
                top: s - i.top + i.marginTop,
                left: a - i.left + i.marginLeft,
                width: o,
                height: r
            })
        }(s, o);
        else {
            var a;
            "scrollParent" === i ? "BODY" === (a = h(p(t))).nodeName && (a = e.ownerDocument.documentElement) : a = "window" === i ? e.ownerDocument.documentElement : i;
            var l = k(a, s, o);
            if ("HTML" !== a.nodeName || function e(t) {
                    var n = t.nodeName;
                    return "BODY" !== n && "HTML" !== n && ("fixed" === w(t, "position") || e(p(t)))
                }(s)) r = l;
            else {
                var c = v(),
                    u = c.height,
                    d = c.width;
                r.top += l.top - l.marginTop, r.bottom = u + l.top, r.left += l.left - l.marginLeft, r.right = d + l.left
            }
        }
        return r.left += n, r.top += n, r.right -= n, r.bottom -= n, r
    }

    function a(e, t, i, n, o) {
        var r = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 0;
        if (-1 === e.indexOf("auto")) return e;
        var s = T(i, n, r, o),
            a = {
                top: {
                    width: s.width,
                    height: t.top - s.top
                },
                right: {
                    width: s.right - t.right,
                    height: s.height
                },
                bottom: {
                    width: s.width,
                    height: s.bottom - t.bottom
                },
                left: {
                    width: t.left - s.left,
                    height: s.height
                }
            },
            l = Object.keys(a).map(function(e) {
                return X({
                    key: e
                }, a[e], {
                    area: (t = a[e], t.width * t.height)
                });
                var t
            }).sort(function(e, t) {
                return t.area - e.area
            }),
            c = l.filter(function(e) {
                var t = e.width,
                    n = e.height;
                return t >= i.clientWidth && n >= i.clientHeight
            }),
            u = 0 < c.length ? c[0].key : l[0].key,
            d = e.split("-")[1];
        return u + (d ? "-" + d : "")
    }

    function l(e, t, n) {
        var i = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : null;
        return k(n, i ? S(t) : f(t, n), i)
    }

    function C(e) {
        var t = getComputedStyle(e),
            n = parseFloat(t.marginTop) + parseFloat(t.marginBottom),
            i = parseFloat(t.marginLeft) + parseFloat(t.marginRight);
        return {
            width: e.offsetWidth + i,
            height: e.offsetHeight + n
        }
    }

    function E(e) {
        var t = {
            left: "right",
            right: "left",
            bottom: "top",
            top: "bottom"
        };
        return e.replace(/left|right|bottom|top/g, function(e) {
            return t[e]
        })
    }

    function A(e, t, n) {
        n = n.split("-")[0];
        var i = C(e),
            o = {
                width: i.width,
                height: i.height
            },
            r = -1 !== ["right", "left"].indexOf(n),
            s = r ? "top" : "left",
            a = r ? "left" : "top",
            l = r ? "height" : "width",
            c = r ? "width" : "height";
        return o[s] = t[s] + t[l] / 2 - i[l] / 2, o[a] = n === a ? t[a] - i[c] : t[E(a)], o
    }

    function $(e, t) {
        return Array.prototype.find ? e.find(t) : e.filter(t)[0]
    }

    function N(e, n, t) {
        return (void 0 === t ? e : e.slice(0, function(e, t, n) {
            if (Array.prototype.findIndex) return e.findIndex(function(e) {
                return e[t] === n
            });
            var i = $(e, function(e) {
                return e[t] === n
            });
            return e.indexOf(i)
        }(e, "name", t))).forEach(function(e) {
            e.function && console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
            var t = e.function || e.fn;
            e.enabled && s(t) && (n.offsets.popper = x(n.offsets.popper), n.offsets.reference = x(n.offsets.reference), n = t(n, e))
        }), n
    }

    function e(e, n) {
        return e.some(function(e) {
            var t = e.name;
            return e.enabled && t === n
        })
    }

    function O(e) {
        for (var t = [!1, "ms", "Webkit", "Moz", "O"], n = e.charAt(0).toUpperCase() + e.slice(1), i = 0; i < t.length; i++) {
            var o = t[i],
                r = o ? "" + o + n : e;
            if (void 0 !== document.body.style[r]) return r
        }
        return null
    }

    function r(e) {
        var t = e.ownerDocument;
        return t ? t.defaultView : window
    }

    function t(e, t, n, i) {
        n.updateBound = i, r(e).addEventListener("resize", n.updateBound, {
            passive: !0
        });
        var o = h(e);
        return function e(t, n, i, o) {
            var r = "BODY" === t.nodeName,
                s = r ? t.ownerDocument.defaultView : t;
            s.addEventListener(n, i, {
                passive: !0
            }), r || e(h(s.parentNode), n, i, o), o.push(s)
        }(o, "scroll", n.updateBound, n.scrollParents), n.scrollElement = o, n.eventsEnabled = !0, n
    }

    function n() {
        var e, t;
        this.state.eventsEnabled && (cancelAnimationFrame(this.scheduleUpdate), this.state = (e = this.reference, t = this.state, r(e).removeEventListener("resize", t.updateBound), t.scrollParents.forEach(function(e) {
            e.removeEventListener("scroll", t.updateBound)
        }), t.updateBound = null, t.scrollParents = [], t.scrollElement = null, t.eventsEnabled = !1, t))
    }

    function D(e) {
        return "" !== e && !isNaN(parseFloat(e)) && isFinite(e)
    }

    function c(n, i) {
        Object.keys(i).forEach(function(e) {
            var t = ""; - 1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(e) && D(i[e]) && (t = "px"), n.style[e] = i[e] + t
        })
    }

    function j(e, t, n) {
        var i = $(e, function(e) {
                return e.name === t
            }),
            o = !!i && e.some(function(e) {
                return e.name === n && e.enabled && e.order < i.order
            });
        if (!o) {
            var r = "`" + t + "`";
            console.warn("`" + n + "` modifier is required by " + r + " modifier in order to work, be sure to include it before " + r + "!")
        }
        return o
    }

    function o(e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
            n = K.indexOf(e),
            i = K.slice(n + 1).concat(K.slice(0, n));
        return t ? i.reverse() : i
    }

    function L(e, o, r, t) {
        var s = [0, 0],
            a = -1 !== ["right", "left"].indexOf(t),
            n = e.split(/(\+|\-)/).map(function(e) {
                return e.trim()
            }),
            i = n.indexOf($(n, function(e) {
                return -1 !== e.search(/,|\s/)
            }));
        n[i] && -1 === n[i].indexOf(",") && console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");
        var l = /\s*,\s*|\s+/,
            c = -1 === i ? [n] : [n.slice(0, i).concat([n[i].split(l)[0]]), [n[i].split(l)[1]].concat(n.slice(i + 1))];
        return (c = c.map(function(e, t) {
            var n = (1 === t ? !a : a) ? "height" : "width",
                i = !1;
            return e.reduce(function(e, t) {
                return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t) ? (e[e.length - 1] = t, i = !0, e) : i ? (e[e.length - 1] += t, i = !1, e) : e.concat(t)
            }, []).map(function(e) {
                return function(e, t, n, i) {
                    var o = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                        r = +o[1],
                        s = o[2];
                    if (!r) return e;
                    if (0 === s.indexOf("%")) {
                        var a;
                        switch (s) {
                            case "%p":
                                a = n;
                                break;
                            case "%":
                            case "%r":
                            default:
                                a = i
                        }
                        return x(a)[t] / 100 * r
                    }
                    return "vh" === s || "vw" === s ? ("vh" === s ? q(document.documentElement.clientHeight, window.innerHeight || 0) : q(document.documentElement.clientWidth, window.innerWidth || 0)) / 100 * r : r
                }(e, n, o, r)
            })
        })).forEach(function(n, i) {
            n.forEach(function(e, t) {
                D(e) && (s[i] += e * ("-" === n[t - 1] ? -1 : 1))
            })
        }), s
    }
    for (var P = Math.min, H = Math.round, M = Math.floor, q = Math.max, I = "undefined" != typeof window && "undefined" != typeof document, F = ["Edge", "Trident", "Firefox"], _ = 0, z = 0; z < F.length; z += 1)
        if (I && 0 <= navigator.userAgent.indexOf(F[z])) {
            _ = 1;
            break
        }
    var W = I && window.Promise ? function(e) {
            var t = !1;
            return function() {
                t || (t = !0, window.Promise.resolve().then(function() {
                    t = !1, e()
                }))
            }
        } : function(e) {
            var t = !1;
            return function() {
                t || (t = !0, setTimeout(function() {
                    t = !1, e()
                }, _))
            }
        },
        R = I && !(!window.MSInputMethodContext || !document.documentMode),
        U = I && /MSIE 10/.test(navigator.userAgent),
        B = function() {
            function i(e, t) {
                for (var n, i = 0; i < t.length; i++)(n = t[i]).enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
            }
            return function(e, t, n) {
                return t && i(e.prototype, t), n && i(e, n), e
            }
        }(),
        V = function(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        },
        X = Object.assign || function(e) {
            for (var t, n = 1; n < arguments.length; n++)
                for (var i in t = arguments[n]) Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
            return e
        },
        Y = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
        K = Y.slice(3),
        Q = "flip",
        G = "clockwise",
        J = "counterclockwise",
        Z = function() {
            function r(e, t) {
                var n = this,
                    i = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};
                (function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                })(this, r), this.scheduleUpdate = function() {
                    return requestAnimationFrame(n.update)
                }, this.update = W(this.update.bind(this)), this.options = X({}, r.Defaults, i), this.state = {
                    isDestroyed: !1,
                    isCreated: !1,
                    scrollParents: []
                }, this.reference = e && e.jquery ? e[0] : e, this.popper = t && t.jquery ? t[0] : t, this.options.modifiers = {}, Object.keys(X({}, r.Defaults.modifiers, i.modifiers)).forEach(function(e) {
                    n.options.modifiers[e] = X({}, r.Defaults.modifiers[e] || {}, i.modifiers ? i.modifiers[e] : {})
                }), this.modifiers = Object.keys(this.options.modifiers).map(function(e) {
                    return X({
                        name: e
                    }, n.options.modifiers[e])
                }).sort(function(e, t) {
                    return e.order - t.order
                }), this.modifiers.forEach(function(e) {
                    e.enabled && s(e.onLoad) && e.onLoad(n.reference, n.popper, n.options, e, n.state)
                }), this.update();
                var o = this.options.eventsEnabled;
                o && this.enableEventListeners(), this.state.eventsEnabled = o
            }
            return B(r, [{
                key: "update",
                value: function() {
                    return function() {
                        if (!this.state.isDestroyed) {
                            var e = {
                                instance: this,
                                styles: {},
                                arrowStyles: {},
                                attributes: {},
                                flipped: !1,
                                offsets: {}
                            };
                            e.offsets.reference = l(this.state, this.popper, this.reference, this.options.positionFixed), e.placement = a(this.options.placement, e.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding), e.originalPlacement = e.placement, e.positionFixed = this.options.positionFixed, e.offsets.popper = A(this.popper, e.offsets.reference, e.placement), e.offsets.popper.position = this.options.positionFixed ? "fixed" : "absolute", e = N(this.modifiers, e), this.state.isCreated ? this.options.onUpdate(e) : (this.state.isCreated = !0, this.options.onCreate(e))
                        }
                    }.call(this)
                }
            }, {
                key: "destroy",
                value: function() {
                    return function() {
                        return this.state.isDestroyed = !0, e(this.modifiers, "applyStyle") && (this.popper.removeAttribute("x-placement"), this.popper.style.position = "", this.popper.style.top = "", this.popper.style.left = "", this.popper.style.right = "", this.popper.style.bottom = "", this.popper.style.willChange = "", this.popper.style[O("transform")] = ""), this.disableEventListeners(), this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper), this
                    }.call(this)
                }
            }, {
                key: "enableEventListeners",
                value: function() {
                    return function() {
                        this.state.eventsEnabled || (this.state = t(this.reference, this.options, this.state, this.scheduleUpdate))
                    }.call(this)
                }
            }, {
                key: "disableEventListeners",
                value: function() {
                    return n.call(this)
                }
            }]), r
        }();
    return Z.Utils = ("undefined" == typeof window ? global : window).PopperUtils, Z.placements = Y, Z.Defaults = {
        placement: "bottom",
        positionFixed: !1,
        eventsEnabled: !0,
        removeOnDestroy: !1,
        onCreate: function() {},
        onUpdate: function() {},
        modifiers: {
            shift: {
                order: 100,
                enabled: !0,
                fn: function(e) {
                    var t = e.placement,
                        n = t.split("-")[0],
                        i = t.split("-")[1];
                    if (i) {
                        var o = e.offsets,
                            r = o.reference,
                            s = o.popper,
                            a = -1 !== ["bottom", "top"].indexOf(n),
                            l = a ? "left" : "top",
                            c = a ? "width" : "height",
                            u = {
                                start: V({}, l, r[l]),
                                end: V({}, l, r[l] + r[c] - s[c])
                            };
                        e.offsets.popper = X({}, s, u[i])
                    }
                    return e
                }
            },
            offset: {
                order: 200,
                enabled: !0,
                fn: function(e, t) {
                    var n, i = t.offset,
                        o = e.placement,
                        r = e.offsets,
                        s = r.popper,
                        a = r.reference,
                        l = o.split("-")[0];
                    return n = D(+i) ? [+i, 0] : L(i, s, a, l), "left" === l ? (s.top += n[0], s.left -= n[1]) : "right" === l ? (s.top += n[0], s.left += n[1]) : "top" === l ? (s.left += n[0], s.top -= n[1]) : "bottom" === l && (s.left += n[0], s.top += n[1]), e.popper = s, e
                },
                offset: 0
            },
            preventOverflow: {
                order: 300,
                enabled: !0,
                fn: function(e, i) {
                    var t = i.boundariesElement || y(e.instance.popper);
                    e.instance.reference === t && (t = y(t));
                    var n = O("transform"),
                        o = e.instance.popper.style,
                        r = o.top,
                        s = o.left,
                        a = o[n];
                    o.top = "", o.left = "", o[n] = "";
                    var l = T(e.instance.popper, e.instance.reference, i.padding, t, e.positionFixed);
                    o.top = r, o.left = s, o[n] = a, i.boundaries = l;
                    var c = i.priority,
                        u = e.offsets.popper,
                        d = {
                            primary: function(e) {
                                var t = u[e];
                                return u[e] < l[e] && !i.escapeWithReference && (t = q(u[e], l[e])), V({}, e, t)
                            },
                            secondary: function(e) {
                                var t = "right" === e ? "left" : "top",
                                    n = u[t];
                                return u[e] > l[e] && !i.escapeWithReference && (n = P(u[t], l[e] - ("right" === e ? u.width : u.height))), V({}, t, n)
                            }
                        };
                    return c.forEach(function(e) {
                        var t = -1 === ["left", "top"].indexOf(e) ? "secondary" : "primary";
                        u = X({}, u, d[t](e))
                    }), e.offsets.popper = u, e
                },
                priority: ["left", "right", "top", "bottom"],
                padding: 5,
                boundariesElement: "scrollParent"
            },
            keepTogether: {
                order: 400,
                enabled: !0,
                fn: function(e) {
                    var t = e.offsets,
                        n = t.popper,
                        i = t.reference,
                        o = e.placement.split("-")[0],
                        r = M,
                        s = -1 !== ["top", "bottom"].indexOf(o),
                        a = s ? "right" : "bottom",
                        l = s ? "left" : "top",
                        c = s ? "width" : "height";
                    return n[a] < r(i[l]) && (e.offsets.popper[l] = r(i[l]) - n[c]), n[l] > r(i[a]) && (e.offsets.popper[l] = r(i[a])), e
                }
            },
            arrow: {
                order: 500,
                enabled: !0,
                fn: function(e, t) {
                    var n;
                    if (!j(e.instance.modifiers, "arrow", "keepTogether")) return e;
                    var i = t.element;
                    if ("string" == typeof i) {
                        if (!(i = e.instance.popper.querySelector(i))) return e
                    } else if (!e.instance.popper.contains(i)) return console.warn("WARNING: `arrow.element` must be child of its popper element!"), e;
                    var o = e.placement.split("-")[0],
                        r = e.offsets,
                        s = r.popper,
                        a = r.reference,
                        l = -1 !== ["left", "right"].indexOf(o),
                        c = l ? "height" : "width",
                        u = l ? "Top" : "Left",
                        d = u.toLowerCase(),
                        p = l ? "left" : "top",
                        f = l ? "bottom" : "right",
                        h = C(i)[c];
                    a[f] - h < s[d] && (e.offsets.popper[d] -= s[d] - (a[f] - h)), a[d] + h > s[f] && (e.offsets.popper[d] += a[d] + h - s[f]), e.offsets.popper = x(e.offsets.popper);
                    var g = a[d] + a[c] / 2 - h / 2,
                        m = w(e.instance.popper),
                        v = parseFloat(m["margin" + u], 10),
                        y = parseFloat(m["border" + u + "Width"], 10),
                        b = g - e.offsets.popper[d] - v - y;
                    return b = q(P(s[c] - h, b), 0), e.arrowElement = i, e.offsets.arrow = (V(n = {}, d, H(b)), V(n, p, ""), n), e
                },
                element: "[x-arrow]"
            },
            flip: {
                order: 600,
                enabled: !0,
                fn: function(h, g) {
                    if (e(h.instance.modifiers, "inner")) return h;
                    if (h.flipped && h.placement === h.originalPlacement) return h;
                    var m = T(h.instance.popper, h.instance.reference, g.padding, g.boundariesElement, h.positionFixed),
                        v = h.placement.split("-")[0],
                        y = E(v),
                        b = h.placement.split("-")[1] || "",
                        w = [];
                    switch (g.behavior) {
                        case Q:
                            w = [v, y];
                            break;
                        case G:
                            w = o(v);
                            break;
                        case J:
                            w = o(v, !0);
                            break;
                        default:
                            w = g.behavior
                    }
                    return w.forEach(function(e, t) {
                        if (v !== e || w.length === t + 1) return h;
                        v = h.placement.split("-")[0], y = E(v);
                        var n, i = h.offsets.popper,
                            o = h.offsets.reference,
                            r = M,
                            s = "left" === v && r(i.right) > r(o.left) || "right" === v && r(i.left) < r(o.right) || "top" === v && r(i.bottom) > r(o.top) || "bottom" === v && r(i.top) < r(o.bottom),
                            a = r(i.left) < r(m.left),
                            l = r(i.right) > r(m.right),
                            c = r(i.top) < r(m.top),
                            u = r(i.bottom) > r(m.bottom),
                            d = "left" === v && a || "right" === v && l || "top" === v && c || "bottom" === v && u,
                            p = -1 !== ["top", "bottom"].indexOf(v),
                            f = !!g.flipVariations && (p && "start" === b && a || p && "end" === b && l || !p && "start" === b && c || !p && "end" === b && u);
                        (s || d || f) && (h.flipped = !0, (s || d) && (v = w[t + 1]), f && (b = "end" === (n = b) ? "start" : "start" === n ? "end" : n), h.placement = v + (b ? "-" + b : ""), h.offsets.popper = X({}, h.offsets.popper, A(h.instance.popper, h.offsets.reference, h.placement)), h = N(h.instance.modifiers, h, "flip"))
                    }), h
                },
                behavior: "flip",
                padding: 5,
                boundariesElement: "viewport"
            },
            inner: {
                order: 700,
                enabled: !1,
                fn: function(e) {
                    var t = e.placement,
                        n = t.split("-")[0],
                        i = e.offsets,
                        o = i.popper,
                        r = i.reference,
                        s = -1 !== ["left", "right"].indexOf(n),
                        a = -1 === ["top", "left"].indexOf(n);
                    return o[s ? "left" : "top"] = r[n] - (a ? o[s ? "width" : "height"] : 0), e.placement = E(t), e.offsets.popper = x(o), e
                }
            },
            hide: {
                order: 800,
                enabled: !0,
                fn: function(e) {
                    if (!j(e.instance.modifiers, "hide", "preventOverflow")) return e;
                    var t = e.offsets.reference,
                        n = $(e.instance.modifiers, function(e) {
                            return "preventOverflow" === e.name
                        }).boundaries;
                    if (t.bottom < n.top || t.left > n.right || t.top > n.bottom || t.right < n.left) {
                        if (!0 === e.hide) return e;
                        e.hide = !0, e.attributes["x-out-of-boundaries"] = ""
                    } else {
                        if (!1 === e.hide) return e;
                        e.hide = !1, e.attributes["x-out-of-boundaries"] = !1
                    }
                    return e
                }
            },
            computeStyle: {
                order: 850,
                enabled: !0,
                fn: function(e, t) {
                    var n = t.x,
                        i = t.y,
                        o = e.offsets.popper,
                        r = $(e.instance.modifiers, function(e) {
                            return "applyStyle" === e.name
                        }).gpuAcceleration;
                    void 0 !== r && console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");
                    var s, a, l = void 0 === r ? t.gpuAcceleration : r,
                        c = b(y(e.instance.popper)),
                        u = {
                            position: o.position
                        },
                        d = {
                            left: M(o.left),
                            top: H(o.top),
                            bottom: H(o.bottom),
                            right: M(o.right)
                        },
                        p = "bottom" === n ? "top" : "bottom",
                        f = "right" === i ? "left" : "right",
                        h = O("transform");
                    if (a = "bottom" == p ? -c.height + d.bottom : d.top, s = "right" == f ? -c.width + d.right : d.left, l && h) u[h] = "translate3d(" + s + "px, " + a + "px, 0)", u[p] = 0, u[f] = 0, u.willChange = "transform";
                    else {
                        var g = "bottom" == p ? -1 : 1,
                            m = "right" == f ? -1 : 1;
                        u[p] = a * g, u[f] = s * m, u.willChange = p + ", " + f
                    }
                    var v = {
                        "x-placement": e.placement
                    };
                    return e.attributes = X({}, v, e.attributes), e.styles = X({}, u, e.styles), e.arrowStyles = X({}, e.offsets.arrow, e.arrowStyles), e
                },
                gpuAcceleration: !0,
                x: "bottom",
                y: "right"
            },
            applyStyle: {
                order: 900,
                enabled: !0,
                fn: function(e) {
                    return c(e.instance.popper, e.styles), t = e.instance.popper, n = e.attributes, Object.keys(n).forEach(function(e) {
                        !1 === n[e] ? t.removeAttribute(e) : t.setAttribute(e, n[e])
                    }), e.arrowElement && Object.keys(e.arrowStyles).length && c(e.arrowElement, e.arrowStyles), e;
                    var t, n
                },
                onLoad: function(e, t, n, i, o) {
                    var r = l(o, t, e, n.positionFixed),
                        s = a(n.placement, r, t, e, n.modifiers.flip.boundariesElement, n.modifiers.flip.padding);
                    return t.setAttribute("x-placement", s), c(t, {
                        position: n.positionFixed ? "fixed" : "absolute"
                    }), n
                },
                gpuAcceleration: void 0
            }
        }
    }, Z
}),
function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = t(require("jquery"), require("popper.js"), require("./util.js")) : "function" == typeof define && define.amd ? define(["jquery", "popper.js", "./util.js"], t) : e.Dropdown = t(e.jQuery, e.Popper, e.Util)
}(this, function(e, r, s) {
    "use strict";

    function o(e, t) {
        for (var n = 0; n < t.length; n++) {
            var i = t[n];
            i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
        }
    }

    function a(o) {
        for (var e = 1; e < arguments.length; e++) {
            var r = null != arguments[e] ? arguments[e] : {},
                t = Object.keys(r);
            "function" == typeof Object.getOwnPropertySymbols && (t = t.concat(Object.getOwnPropertySymbols(r).filter(function(e) {
                return Object.getOwnPropertyDescriptor(r, e).enumerable
            }))), t.forEach(function(e) {
                var t, n, i;
                t = o, i = r[n = e], n in t ? Object.defineProperty(t, n, {
                    value: i,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0
                }) : t[n] = i
            })
        }
        return o
    }
    var u, l, d, p, t, n, f, h, g, m, v, y, b, w, x, k, i, S, T, C, E, A, $, N, O, D, j, L, c;
    return e = e && e.hasOwnProperty("default") ? e.default : e, r = r && r.hasOwnProperty("default") ? r.default : r, s = s && s.hasOwnProperty("default") ? s.default : s, l = "dropdown", p = "." + (d = "bs.dropdown"), t = ".data-api", n = (u = e).fn[l], f = new RegExp("38|40|27"), h = {
        HIDE: "hide" + p,
        HIDDEN: "hidden" + p,
        SHOW: "show" + p,
        SHOWN: "shown" + p,
        CLICK: "click" + p,
        CLICK_DATA_API: "click" + p + t,
        KEYDOWN_DATA_API: "keydown" + p + t,
        KEYUP_DATA_API: "keyup" + p + t
    }, g = "disabled", m = "show", v = "dropup", y = "dropright", b = "dropleft", w = "dropdown-menu-right", x = "position-static", k = '[data-toggle="dropdown"]', i = ".dropdown form", S = ".dropdown-menu", T = ".navbar-nav", C = ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)", E = "top-start", A = "top-end", $ = "bottom-start", N = "bottom-end", O = "right-start", D = "left-start", j = {
        offset: 0,
        flip: !0,
        boundary: "scrollParent",
        reference: "toggle",
        display: "dynamic"
    }, L = {
        offset: "(number|string|function)",
        flip: "boolean",
        boundary: "(string|element)",
        reference: "(string|element)",
        display: "string"
    }, c = function() {
        function c(e, t) {
            this._element = e, this._popper = null, this._config = this._getConfig(t), this._menu = this._getMenuElement(), this._inNavbar = this._detectNavbar(), this._addEventListeners()
        }
        var e, t, n, i = c.prototype;
        return i.toggle = function() {
            if (!this._element.disabled && !u(this._element).hasClass(g)) {
                var e = c._getParentFromElement(this._element),
                    t = u(this._menu).hasClass(m);
                if (c._clearMenus(), !t) {
                    var n = {
                            relatedTarget: this._element
                        },
                        i = u.Event(h.SHOW, n);
                    if (u(e).trigger(i), !i.isDefaultPrevented()) {
                        if (!this._inNavbar) {
                            if (void 0 === r) throw new TypeError("Bootstrap dropdown require Popper.js (https://popper.js.org)");
                            var o = this._element;
                            "parent" === this._config.reference ? o = e : s.isElement(this._config.reference) && (o = this._config.reference, void 0 !== this._config.reference.jquery && (o = this._config.reference[0])), "scrollParent" !== this._config.boundary && u(e).addClass(x), this._popper = new r(o, this._menu, this._getPopperConfig())
                        }
                        "ontouchstart" in document.documentElement && 0 === u(e).closest(T).length && u(document.body).children().on("mouseover", null, u.noop), this._element.focus(), this._element.setAttribute("aria-expanded", !0), u(this._menu).toggleClass(m), u(e).toggleClass(m).trigger(u.Event(h.SHOWN, n))
                    }
                }
            }
        }, i.dispose = function() {
            u.removeData(this._element, d), u(this._element).off(p), this._element = null, (this._menu = null) !== this._popper && (this._popper.destroy(), this._popper = null)
        }, i.update = function() {
            this._inNavbar = this._detectNavbar(), null !== this._popper && this._popper.scheduleUpdate()
        }, i._addEventListeners = function() {
            var t = this;
            u(this._element).on(h.CLICK, function(e) {
                e.preventDefault(), e.stopPropagation(), t.toggle()
            })
        }, i._getConfig = function(e) {
            return e = a({}, this.constructor.Default, u(this._element).data(), e), s.typeCheckConfig(l, e, this.constructor.DefaultType), e
        }, i._getMenuElement = function() {
            if (!this._menu) {
                var e = c._getParentFromElement(this._element);
                e && (this._menu = e.querySelector(S))
            }
            return this._menu
        }, i._getPlacement = function() {
            var e = u(this._element.parentNode),
                t = $;
            return e.hasClass(v) ? (t = E, u(this._menu).hasClass(w) && (t = A)) : e.hasClass(y) ? t = O : e.hasClass(b) ? t = D : u(this._menu).hasClass(w) && (t = N), t
        }, i._detectNavbar = function() {
            return 0 < u(this._element).closest(".navbar").length
        }, i._getPopperConfig = function() {
            var t = this,
                e = {};
            "function" == typeof this._config.offset ? e.fn = function(e) {
                return e.offsets = a({}, e.offsets, t._config.offset(e.offsets) || {}), e
            } : e.offset = this._config.offset;
            var n = {
                placement: this._getPlacement(),
                modifiers: {
                    offset: e,
                    flip: {
                        enabled: this._config.flip
                    },
                    preventOverflow: {
                        boundariesElement: this._config.boundary
                    }
                }
            };
            return "static" === this._config.display && (n.modifiers.applyStyle = {
                enabled: !1
            }), n
        }, c._jQueryInterface = function(t) {
            return this.each(function() {
                var e = u(this).data(d);
                if (e || (e = new c(this, "object" == typeof t ? t : null), u(this).data(d, e)), "string" == typeof t) {
                    if (void 0 === e[t]) throw new TypeError('No method named "' + t + '"');
                    e[t]()
                }
            })
        }, c._clearMenus = function(e) {
            if (!e || 3 !== e.which && ("keyup" !== e.type || 9 === e.which))
                for (var t = [].slice.call(document.querySelectorAll(k)), n = 0, i = t.length; n < i; n++) {
                    var o = c._getParentFromElement(t[n]),
                        r = u(t[n]).data(d),
                        s = {
                            relatedTarget: t[n]
                        };
                    if (e && "click" === e.type && (s.clickEvent = e), r) {
                        var a = r._menu;
                        if (u(o).hasClass(m) && !(e && ("click" === e.type && /input|textarea/i.test(e.target.tagName) || "keyup" === e.type && 9 === e.which) && u.contains(o, e.target))) {
                            var l = u.Event(h.HIDE, s);
                            u(o).trigger(l), l.isDefaultPrevented() || ("ontouchstart" in document.documentElement && u(document.body).children().off("mouseover", null, u.noop), t[n].setAttribute("aria-expanded", "false"), u(a).removeClass(m), u(o).removeClass(m).trigger(u.Event(h.HIDDEN, s)))
                        }
                    }
                }
        }, c._getParentFromElement = function(e) {
            var t, n = s.getSelectorFromElement(e);
            return n && (t = document.querySelector(n)), t || e.parentNode
        }, c._dataApiKeydownHandler = function(e) {
            if ((/input|textarea/i.test(e.target.tagName) ? !(32 === e.which || 27 !== e.which && (40 !== e.which && 38 !== e.which || u(e.target).closest(S).length)) : f.test(e.which)) && (e.preventDefault(), e.stopPropagation(), !this.disabled && !u(this).hasClass(g))) {
                var t = c._getParentFromElement(this),
                    n = u(t).hasClass(m);
                if ((n || 27 === e.which && 32 === e.which) && (!n || 27 !== e.which && 32 !== e.which)) {
                    var i = [].slice.call(t.querySelectorAll(C));
                    if (0 !== i.length) {
                        var o = i.indexOf(e.target);
                        38 === e.which && 0 < o && o--, 40 === e.which && o < i.length - 1 && o++, o < 0 && (o = 0), i[o].focus()
                    }
                } else {
                    if (27 === e.which) {
                        var r = t.querySelector(k);
                        u(r).trigger("focus")
                    }
                    u(this).trigger("click")
                }
            }
        }, e = c, n = [{
            key: "VERSION",
            get: function() {
                return "4.1.3"
            }
        }, {
            key: "Default",
            get: function() {
                return j
            }
        }, {
            key: "DefaultType",
            get: function() {
                return L
            }
        }], (t = null) && o(e.prototype, t), n && o(e, n), c
    }(), u(document).on(h.KEYDOWN_DATA_API, k, c._dataApiKeydownHandler).on(h.KEYDOWN_DATA_API, S, c._dataApiKeydownHandler).on(h.CLICK_DATA_API + " " + h.KEYUP_DATA_API, c._clearMenus).on(h.CLICK_DATA_API, k, function(e) {
        e.preventDefault(), e.stopPropagation(), c._jQueryInterface.call(u(this), "toggle")
    }).on(h.CLICK_DATA_API, i, function(e) {
        e.stopPropagation()
    }), u.fn[l] = c._jQueryInterface, u.fn[l].Constructor = c, u.fn[l].noConflict = function() {
        return u.fn[l] = n, c._jQueryInterface
    }, c
}),
function(e) {
    "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? module.exports = e() : window.noUiSlider = e()
}(function() {
    "use strict";

    function a(e) {
        return null != e
    }

    function G(e) {
        e.preventDefault()
    }

    function o(e) {
        return "number" == typeof e && !isNaN(e) && isFinite(e)
    }

    function J(e, t, n) {
        0 < n && (te(e, t), setTimeout(function() {
            ne(e, t)
        }, n))
    }

    function Z(e) {
        return Math.max(Math.min(e, 100), 0)
    }

    function ee(e) {
        return Array.isArray(e) ? e : [e]
    }

    function t(e) {
        var t = (e = String(e)).split(".");
        return 1 < t.length ? t[1].length : 0
    }

    function te(e, t) {
        e.classList ? e.classList.add(t) : e.className += " " + t
    }

    function ne(e, t) {
        e.classList ? e.classList.remove(t) : e.className = e.className.replace(new RegExp("(^|\\b)" + t.split(" ").join("|") + "(\\b|$)", "gi"), " ")
    }

    function ie(e) {
        var t = void 0 !== window.pageXOffset,
            n = "CSS1Compat" === (e.compatMode || "");
        return {
            x: t ? window.pageXOffset : n ? e.documentElement.scrollLeft : e.body.scrollLeft,
            y: t ? window.pageYOffset : n ? e.documentElement.scrollTop : e.body.scrollTop
        }
    }

    function u(e, t) {
        return 100 / (t - e)
    }

    function d(e, t) {
        return 100 * t / (e[1] - e[0])
    }

    function p(e, t) {
        for (var n = 1; e >= t[n];) n += 1;
        return n
    }

    function n(e, t, n) {
        if (n >= e.slice(-1)[0]) return 100;
        var i, o, r = p(n, e),
            s = e[r - 1],
            a = e[r],
            l = t[r - 1],
            c = t[r];
        return l + (o = n, d(i = [s, a], i[0] < 0 ? o + Math.abs(i[0]) : o - i[0]) / u(l, c))
    }

    function i(e, t, n, i) {
        if (100 === i) return i;
        var o, r, s = p(i, e),
            a = e[s - 1],
            l = e[s];
        return n ? (l - a) / 2 < i - a ? l : a : t[s - 1] ? e[s - 1] + (o = i - e[s - 1], r = t[s - 1], Math.round(o / r) * r) : i
    }

    function r(e, t, n) {
        var i;
        if ("number" == typeof t && (t = [t]), !Array.isArray(t)) throw new Error("noUiSlider (" + re + "): 'range' contains invalid value.");
        if (!o(i = "min" === e ? 0 : "max" === e ? 100 : parseFloat(e)) || !o(t[0])) throw new Error("noUiSlider (" + re + "): 'range' value isn't numeric.");
        n.xPct.push(i), n.xVal.push(t[0]), i ? n.xSteps.push(!isNaN(t[1]) && t[1]) : isNaN(t[1]) || (n.xSteps[0] = t[1]), n.xHighestCompleteStep.push(0)
    }

    function s(e, t, n) {
        if (!t) return !0;
        n.xSteps[e] = d([n.xVal[e], n.xVal[e + 1]], t) / u(n.xPct[e], n.xPct[e + 1]);
        var i = (n.xVal[e + 1] - n.xVal[e]) / n.xNumSteps[e],
            o = Math.ceil(Number(i.toFixed(3)) - 1),
            r = n.xVal[e] + n.xNumSteps[e] * o;
        n.xHighestCompleteStep[e] = r
    }

    function l(e, t, n) {
        this.xPct = [], this.xVal = [], this.xSteps = [n || !1], this.xNumSteps = [!1], this.xHighestCompleteStep = [], this.snap = t;
        var i, o = [];
        for (i in e) e.hasOwnProperty(i) && o.push([e[i], i]);
        for (o.length && "object" == typeof o[0][0] ? o.sort(function(e, t) {
                return e[0][0] - t[0][0]
            }) : o.sort(function(e, t) {
                return e[0] - t[0]
            }), i = 0; i < o.length; i++) r(o[i][1], o[i][0], this);
        for (this.xNumSteps = this.xSteps.slice(0), i = 0; i < this.xNumSteps.length; i++) s(i, this.xNumSteps[i], this)
    }

    function c(e) {
        if ("object" == typeof(t = e) && "function" == typeof t.to && "function" == typeof t.from) return !0;
        var t;
        throw new Error("noUiSlider (" + re + "): 'format' requires 'to' and 'from' methods.")
    }

    function f(e, t) {
        if (!o(t)) throw new Error("noUiSlider (" + re + "): 'step' is not numeric.");
        e.singleStep = t
    }

    function h(e, t) {
        if ("object" != typeof t || Array.isArray(t)) throw new Error("noUiSlider (" + re + "): 'range' is not an object.");
        if (void 0 === t.min || void 0 === t.max) throw new Error("noUiSlider (" + re + "): Missing 'min' or 'max' in 'range'.");
        if (t.min === t.max) throw new Error("noUiSlider (" + re + "): 'range' 'min' and 'max' cannot be equal.");
        e.spectrum = new l(t, e.snap, e.singleStep)
    }

    function g(e, t) {
        if (t = ee(t), !Array.isArray(t) || !t.length) throw new Error("noUiSlider (" + re + "): 'start' option is incorrect.");
        e.handles = t.length, e.start = t
    }

    function m(e, t) {
        if ("boolean" != typeof(e.snap = t)) throw new Error("noUiSlider (" + re + "): 'snap' option must be a boolean.")
    }

    function v(e, t) {
        if ("boolean" != typeof(e.animate = t)) throw new Error("noUiSlider (" + re + "): 'animate' option must be a boolean.")
    }

    function y(e, t) {
        if ("number" != typeof(e.animationDuration = t)) throw new Error("noUiSlider (" + re + "): 'animationDuration' option must be a number.")
    }

    function b(e, t) {
        var n, i = [!1];
        if ("lower" === t ? t = [!0, !1] : "upper" === t && (t = [!1, !0]), !0 === t || !1 === t) {
            for (n = 1; n < e.handles; n++) i.push(t);
            i.push(!1)
        } else {
            if (!Array.isArray(t) || !t.length || t.length !== e.handles + 1) throw new Error("noUiSlider (" + re + "): 'connect' option doesn't match handle count.");
            i = t
        }
        e.connect = i
    }

    function w(e, t) {
        switch (t) {
            case "horizontal":
                e.ort = 0;
                break;
            case "vertical":
                e.ort = 1;
                break;
            default:
                throw new Error("noUiSlider (" + re + "): 'orientation' option is invalid.")
        }
    }

    function x(e, t) {
        if (!o(t)) throw new Error("noUiSlider (" + re + "): 'margin' option must be numeric.");
        if (0 !== t && (e.margin = e.spectrum.getMargin(t), !e.margin)) throw new Error("noUiSlider (" + re + "): 'margin' option is only supported on linear sliders.")
    }

    function k(e, t) {
        if (!o(t)) throw new Error("noUiSlider (" + re + "): 'limit' option must be numeric.");
        if (e.limit = e.spectrum.getMargin(t), !e.limit || e.handles < 2) throw new Error("noUiSlider (" + re + "): 'limit' option is only supported on linear sliders with 2 or more handles.")
    }

    function S(e, t) {
        if (!o(t) && !Array.isArray(t)) throw new Error("noUiSlider (" + re + "): 'padding' option must be numeric or array of exactly 2 numbers.");
        if (Array.isArray(t) && 2 !== t.length && !o(t[0]) && !o(t[1])) throw new Error("noUiSlider (" + re + "): 'padding' option must be numeric or array of exactly 2 numbers.");
        if (0 !== t) {
            if (Array.isArray(t) || (t = [t, t]), !(e.padding = [e.spectrum.getMargin(t[0]), e.spectrum.getMargin(t[1])]) === e.padding[0] || !1 === e.padding[1]) throw new Error("noUiSlider (" + re + "): 'padding' option is only supported on linear sliders.");
            if (e.padding[0] < 0 || e.padding[1] < 0) throw new Error("noUiSlider (" + re + "): 'padding' option must be a positive number(s).");
            if (100 <= e.padding[0] + e.padding[1]) throw new Error("noUiSlider (" + re + "): 'padding' option must not exceed 100% of the range.")
        }
    }

    function T(e, t) {
        switch (t) {
            case "ltr":
                e.dir = 0;
                break;
            case "rtl":
                e.dir = 1;
                break;
            default:
                throw new Error("noUiSlider (" + re + "): 'direction' option was not recognized.")
        }
    }

    function C(e, t) {
        if ("string" != typeof t) throw new Error("noUiSlider (" + re + "): 'behaviour' must be a string containing options.");
        var n = 0 <= t.indexOf("tap"),
            i = 0 <= t.indexOf("drag"),
            o = 0 <= t.indexOf("fixed"),
            r = 0 <= t.indexOf("snap"),
            s = 0 <= t.indexOf("hover");
        if (o) {
            if (2 !== e.handles) throw new Error("noUiSlider (" + re + "): 'fixed' behaviour must be used with 2 handles");
            x(e, e.start[1] - e.start[0])
        }
        e.events = {
            tap: n || r,
            drag: i,
            fixed: o,
            snap: r,
            hover: s
        }
    }

    function E(e, t) {
        if (!1 !== t)
            if (!0 === t) {
                e.tooltips = [];
                for (var n = 0; n < e.handles; n++) e.tooltips.push(!0)
            } else {
                if (e.tooltips = ee(t), e.tooltips.length !== e.handles) throw new Error("noUiSlider (" + re + "): must pass a formatter for all handles.");
                e.tooltips.forEach(function(e) {
                    if ("boolean" != typeof e && ("object" != typeof e || "function" != typeof e.to)) throw new Error("noUiSlider (" + re + "): 'tooltips' must be passed a formatter or 'false'.")
                })
            }
    }

    function A(e, t) {
        c(e.ariaFormat = t)
    }

    function $(e, t) {
        c(e.format = t)
    }

    function N(e, t) {
        if ("string" != typeof t && !1 !== t) throw new Error("noUiSlider (" + re + "): 'cssPrefix' must be a string or `false`.");
        e.cssPrefix = t
    }

    function O(e, t) {
        if ("object" != typeof t) throw new Error("noUiSlider (" + re + "): 'cssClasses' must be an object.");
        if ("string" == typeof e.cssPrefix)
            for (var n in e.cssClasses = {}, t) t.hasOwnProperty(n) && (e.cssClasses[n] = e.cssPrefix + t[n]);
        else e.cssClasses = t
    }

    function oe(t) {
        var n = {
                margin: 0,
                limit: 0,
                padding: 0,
                animate: !0,
                animationDuration: 300,
                ariaFormat: j,
                format: j
            },
            i = {
                step: {
                    r: !1,
                    t: f
                },
                start: {
                    r: !0,
                    t: g
                },
                connect: {
                    r: !0,
                    t: b
                },
                direction: {
                    r: !0,
                    t: T
                },
                snap: {
                    r: !1,
                    t: m
                },
                animate: {
                    r: !1,
                    t: v
                },
                animationDuration: {
                    r: !1,
                    t: y
                },
                range: {
                    r: !0,
                    t: h
                },
                orientation: {
                    r: !1,
                    t: w
                },
                margin: {
                    r: !1,
                    t: x
                },
                limit: {
                    r: !1,
                    t: k
                },
                padding: {
                    r: !1,
                    t: S
                },
                behaviour: {
                    r: !0,
                    t: C
                },
                ariaFormat: {
                    r: !1,
                    t: A
                },
                format: {
                    r: !1,
                    t: $
                },
                tooltips: {
                    r: !1,
                    t: E
                },
                cssPrefix: {
                    r: !0,
                    t: N
                },
                cssClasses: {
                    r: !0,
                    t: O
                }
            },
            o = {
                connect: !1,
                direction: "ltr",
                behaviour: "tap",
                orientation: "horizontal",
                cssPrefix: "noUi-",
                cssClasses: {
                    target: "target",
                    base: "base",
                    origin: "origin",
                    handle: "handle",
                    handleLower: "handle-lower",
                    handleUpper: "handle-upper",
                    horizontal: "horizontal",
                    vertical: "vertical",
                    background: "background",
                    connect: "connect",
                    connects: "connects",
                    ltr: "ltr",
                    rtl: "rtl",
                    draggable: "draggable",
                    drag: "state-drag",
                    tap: "state-tap",
                    active: "active",
                    tooltip: "tooltip",
                    pips: "pips",
                    pipsHorizontal: "pips-horizontal",
                    pipsVertical: "pips-vertical",
                    marker: "marker",
                    markerHorizontal: "marker-horizontal",
                    markerVertical: "marker-vertical",
                    markerNormal: "marker-normal",
                    markerLarge: "marker-large",
                    markerSub: "marker-sub",
                    value: "value",
                    valueHorizontal: "value-horizontal",
                    valueVertical: "value-vertical",
                    valueNormal: "value-normal",
                    valueLarge: "value-large",
                    valueSub: "value-sub"
                }
            };
        t.format && !t.ariaFormat && (t.ariaFormat = t.format), Object.keys(i).forEach(function(e) {
            if (!a(t[e]) && void 0 === o[e]) {
                if (i[e].r) throw new Error("noUiSlider (" + re + "): '" + e + "' is required.");
                return !0
            }
            i[e].t(n, a(t[e]) ? t[e] : o[e])
        }), n.pips = t.pips;
        var e = document.createElement("div"),
            r = void 0 !== e.style.msTransform,
            s = void 0 !== e.style.transform;
        n.transformRule = s ? "transform" : r ? "msTransform" : "webkitTransform";
        return n.style = [
            ["left", "top"],
            ["right", "bottom"]
        ][n.dir][n.ort], n
    }

    function D(e, d, r) {
        function p(e, t) {
            var n = X.createElement("div");
            return t && te(n, t), e.appendChild(n), n
        }

        function a(e, t) {
            return !!t && p(e, d.cssClasses.connect)
        }

        function t(e, t) {
            return !!d.tooltips[t] && p(e.firstChild, d.cssClasses.tooltip)
        }

        function c(t, i, o) {
            function r(e, t) {
                var n = t === d.cssClasses.value,
                    i = n ? a : l;
                return t + " " + (n ? c : u)[d.ort] + " " + i[e]
            }
            var s = X.createElement("div"),
                a = [d.cssClasses.valueNormal, d.cssClasses.valueLarge, d.cssClasses.valueSub],
                l = [d.cssClasses.markerNormal, d.cssClasses.markerLarge, d.cssClasses.markerSub],
                c = [d.cssClasses.valueHorizontal, d.cssClasses.valueVertical],
                u = [d.cssClasses.markerHorizontal, d.cssClasses.markerVertical];
            return te(s, d.cssClasses.pips), te(s, 0 === d.ort ? d.cssClasses.pipsHorizontal : d.cssClasses.pipsVertical), Object.keys(t).forEach(function(e) {
                ! function(e, t) {
                    t[1] = t[1] && i ? i(t[0], t[1]) : t[1];
                    var n = p(s, !1);
                    n.className = r(t[1], d.cssClasses.marker), n.style[d.style] = e + "%", t[1] && ((n = p(s, !1)).className = r(t[1], d.cssClasses.value), n.setAttribute("data-value", t[0]), n.style[d.style] = e + "%", n.innerText = o.to(t[0]))
                }(e, t[e])
            }), s
        }

        function u() {
            var e;
            P && ((e = P).parentElement.removeChild(e), P = null)
        }

        function s(e) {
            u();
            var f, h, g, m, t, n, v, y, b, i = e.mode,
                o = e.density || 1,
                r = e.filter || !1,
                s = function(e, t, n) {
                    if ("range" === e || "steps" === e) return U.xVal;
                    if ("count" === e) {
                        if (t < 2) throw new Error("noUiSlider (" + re + "): 'values' (>= 2) required for mode 'count'.");
                        var i = t - 1,
                            o = 100 / i;
                        for (t = []; i--;) t[i] = i * o;
                        t.push(100), e = "positions"
                    }
                    return "positions" === e ? t.map(function(e) {
                        return U.fromStepping(n ? U.getStep(e) : e)
                    }) : "values" === e ? n ? t.map(function(e) {
                        return U.fromStepping(U.getStep(U.toStepping(e)))
                    }) : t : void 0
                }(i, e.values || !1, e.stepped || !1),
                a = (f = o, h = i, g = s, m = {}, t = U.xVal[0], n = U.xVal[U.xVal.length - 1], y = v = !1, b = 0, (g = g.slice().sort(function(e, t) {
                    return e - t
                }).filter(function(e) {
                    return !this[e] && (this[e] = !0)
                }, {}))[0] !== t && (g.unshift(t), v = !0), g[g.length - 1] !== n && (g.push(n), y = !0), g.forEach(function(e, t) {
                    var n, i, o, r, s, a, l, c, u, d = e,
                        p = g[t + 1];
                    if ("steps" === h && (n = U.xNumSteps[t]), n || (n = p - d), !1 !== d && void 0 !== p)
                        for (n = Math.max(n, 1e-7), i = d; i <= p; i = (i + n).toFixed(7) / 1) {
                            for (l = (s = (r = U.toStepping(i)) - b) / f, u = s / (c = Math.round(l)), o = 1; o <= c; o += 1) m[(b + o * u).toFixed(5)] = ["x", 0];
                            a = -1 < g.indexOf(i) ? 1 : "steps" === h ? 2 : 0, !t && v && (a = 0), i === p && y || (m[r.toFixed(5)] = [i, a]), b = r
                        }
                }), m),
                l = e.format || {
                    to: Math.round
                };
            return P = _.appendChild(c(a, r, l))
        }

        function l() {
            var e = O.getBoundingClientRect(),
                t = "offset" + ["Width", "Height"][d.ort];
            return 0 === d.ort ? e.width || O[t] : e.height || O[t]
        }

        function f(i, o, r, s) {
            var t = function(e) {
                    return !!(e = function(e, t, n) {
                        var i, o, r = 0 === e.type.indexOf("touch"),
                            s = 0 === e.type.indexOf("mouse"),
                            a = 0 === e.type.indexOf("pointer");
                        if (0 === e.type.indexOf("MSPointer") && (a = !0), r) {
                            var l = function(e) {
                                return e.target === n || n.contains(e.target)
                            };
                            if ("touchstart" === e.type) {
                                var c = Array.prototype.filter.call(e.touches, l);
                                if (1 < c.length) return !1;
                                i = c[0].pageX, o = c[0].pageY
                            } else {
                                var u = Array.prototype.find.call(e.changedTouches, l);
                                if (!u) return !1;
                                i = u.pageX, o = u.pageY
                            }
                        }
                        return t = t || ie(X), (s || a) && (i = e.clientX + t.x, o = e.clientY + t.y), e.pageOffset = t, e.points = [i, o], e.cursor = s || a, e
                    }(e, s.pageOffset, s.target || o)) && !(_.hasAttribute("disabled") && !s.doNotReject) && (t = _, n = d.cssClasses.tap, !((t.classList ? t.classList.contains(n) : new RegExp("\\b" + n + "\\b").test(t.className)) && !s.doNotReject) && !(i === I.start && void 0 !== e.buttons && 1 < e.buttons) && (!s.hover || !e.buttons) && (F || e.preventDefault(), e.calcPoint = e.points[d.ort], void r(e, s)));
                    var t, n
                },
                n = [];
            return i.split(" ").forEach(function(e) {
                o.addEventListener(e, t, !!F && {
                    passive: !0
                }), n.push([e, t])
            }), n
        }

        function h(e) {
            var t, n, i, o, r, s, a = 100 * (e - (t = O, n = d.ort, i = t.getBoundingClientRect(), o = t.ownerDocument, r = o.documentElement, s = ie(o), /webkit.*Chrome.*Mobile/i.test(navigator.userAgent) && (s.x = 0), n ? i.top + s.y - r.clientTop : i.left + s.x - r.clientLeft)) / l();
            return a = Z(a), d.dir ? 100 - a : a
        }

        function g(e, t) {
            "mouseout" === e.type && "HTML" === e.target.nodeName && null === e.relatedTarget && v(e, t)
        }

        function m(e, t) {
            if (-1 === navigator.appVersion.indexOf("MSIE 9") && 0 === e.buttons && 0 !== t.buttonsProperty) return v(e, t);
            var n = (d.dir ? -1 : 1) * (e.calcPoint - t.startCalcPoint);
            S(0 < n, 100 * n / t.baseSize, t.locations, t.handleNumbers)
        }

        function v(e, t) {
            t.handle && (ne(t.handle, d.cssClasses.active), R -= 1), t.listeners.forEach(function(e) {
                Y.removeEventListener(e[0], e[1])
            }), 0 === R && (ne(_, d.cssClasses.drag), C(), e.cursor && (K.style.cursor = "", K.removeEventListener("selectstart", G))), t.handleNumbers.forEach(function(e) {
                b("change", e), b("set", e), b("end", e)
            })
        }

        function y(e, t) {
            var n;
            if (1 === t.handleNumbers.length) {
                var i = D[t.handleNumbers[0]];
                if (i.hasAttribute("disabled")) return !1;
                n = i.children[0], R += 1, te(n, d.cssClasses.active)
            }
            e.stopPropagation();
            var o = [],
                r = f(I.move, Y, m, {
                    target: e.target,
                    handle: n,
                    listeners: o,
                    startCalcPoint: e.calcPoint,
                    baseSize: l(),
                    pageOffset: e.pageOffset,
                    handleNumbers: t.handleNumbers,
                    buttonsProperty: e.buttons,
                    locations: z.slice()
                }),
                s = f(I.end, Y, v, {
                    target: e.target,
                    handle: n,
                    listeners: o,
                    doNotReject: !0,
                    handleNumbers: t.handleNumbers
                }),
                a = f("mouseout", Y, g, {
                    target: e.target,
                    handle: n,
                    listeners: o,
                    doNotReject: !0,
                    handleNumbers: t.handleNumbers
                });
            o.push.apply(o, r.concat(s, a)), e.cursor && (K.style.cursor = getComputedStyle(e.target).cursor, 1 < D.length && te(_, d.cssClasses.drag), K.addEventListener("selectstart", G, !1)), t.handleNumbers.forEach(function(e) {
                b("start", e)
            })
        }

        function n(e) {
            e.stopPropagation();
            var i, o, r, t = h(e.calcPoint),
                n = (i = t, r = !(o = 100), D.forEach(function(e, t) {
                    if (!e.hasAttribute("disabled")) {
                        var n = Math.abs(z[t] - i);
                        (n < o || 100 === n && 100 === o) && (r = t, o = n)
                    }
                }), r);
            if (!1 === n) return !1;
            d.events.snap || J(_, d.cssClasses.tap, d.animationDuration), E(n, t, !0, !0), C(), b("slide", n, !0), b("update", n, !0), b("change", n, !0), b("set", n, !0), d.events.snap && y(e, {
                handleNumbers: [n]
            })
        }

        function i(e) {
            var t = h(e.calcPoint),
                n = U.getStep(t),
                i = U.fromStepping(n);
            Object.keys(V).forEach(function(e) {
                "hover" === e.split(".")[0] && V[e].forEach(function(e) {
                    e.call(L, i)
                })
            })
        }

        function o(e, t) {
            V[e] = V[e] || [], V[e].push(t), "update" === e.split(".")[0] && D.forEach(function(e, t) {
                b("update", t)
            })
        }

        function b(n, i, o) {
            Object.keys(V).forEach(function(e) {
                var t = e.split(".")[0];
                n === t && V[e].forEach(function(e) {
                    e.call(L, B.map(d.format.to), i, B.slice(), o || !1, z.slice())
                })
            })
        }

        function w(e) {
            return e + "%"
        }

        function x(e, t, n, i, o, r) {
            return 1 < D.length && (i && 0 < t && (n = Math.max(n, e[t - 1] + d.margin)), o && t < D.length - 1 && (n = Math.min(n, e[t + 1] - d.margin))), 1 < D.length && d.limit && (i && 0 < t && (n = Math.min(n, e[t - 1] + d.limit)), o && t < D.length - 1 && (n = Math.max(n, e[t + 1] - d.limit))), d.padding && (0 === t && (n = Math.max(n, d.padding[0])), t === D.length - 1 && (n = Math.min(n, 100 - d.padding[1]))), !((n = Z(n = U.getStep(n))) === e[t] && !r) && n
        }

        function k(e, t) {
            var n = d.ort;
            return (n ? t : e) + ", " + (n ? e : t)
        }

        function S(e, i, n, t) {
            var o = n.slice(),
                r = [!e, e],
                s = [e, !e];
            t = t.slice(), e && t.reverse(), 1 < t.length ? t.forEach(function(e, t) {
                var n = x(o, e, o[e] + i, r[t], s[t], !1);
                !1 === n ? i = 0 : (i = n - o[e], o[e] = n)
            }) : r = s = [!0];
            var a = !1;
            t.forEach(function(e, t) {
                a = E(e, n[e] + i, r[t], s[t]) || a
            }), a && t.forEach(function(e) {
                b("update", e), b("slide", e)
            })
        }

        function T(e, t) {
            return d.dir ? 100 - e - t : e
        }

        function C() {
            W.forEach(function(e) {
                var t = 50 < z[e] ? -1 : 1,
                    n = 3 + (D.length + t * e);
                D[e].style.zIndex = n
            })
        }

        function E(e, t, n, i) {
            return !1 !== (t = x(z, e, t, n, i, !1)) && (function(e, t) {
                z[e] = t, B[e] = U.fromStepping(t);
                var n = "translate(" + k(w(T(t, 0) - Q), "0") + ")";
                D[e].style[d.transformRule] = n, A(e), A(e + 1)
            }(e, t), !0)
        }

        function A(e) {
            if (j[e]) {
                var t = 0,
                    n = 100;
                0 !== e && (t = z[e - 1]), e !== j.length - 1 && (n = z[e]);
                var i = n - t,
                    o = "translate(" + k(w(T(t, i)), "0") + ")",
                    r = "scale(" + k(i / 100, "1") + ")";
                j[e].style[d.transformRule] = o + " " + r
            }
        }

        function $(e, t) {
            var i = ee(e),
                n = void 0 === z[0];
            t = void 0 === t || !!t, d.animate && !n && J(_, d.cssClasses.tap, d.animationDuration), W.forEach(function(e) {
                var t, n;
                E(e, (t = i[e], n = e, null === t || !1 === t || void 0 === t ? z[n] : ("number" == typeof t && (t = String(t)), t = d.format.from(t), !1 === (t = U.toStepping(t)) || isNaN(t) ? z[n] : t)), !0, !1)
            }), W.forEach(function(e) {
                E(e, z[e], !0, !0)
            }), C(), W.forEach(function(e) {
                b("update", e), null !== i[e] && t && b("set", e)
            })
        }

        function N() {
            var e = B.map(d.format.to);
            return 1 === e.length ? e[0] : e
        }
        var O, D, j, L, P, H, M, q, I = window.navigator.pointerEnabled ? {
                start: "pointerdown",
                move: "pointermove",
                end: "pointerup"
            } : window.navigator.msPointerEnabled ? {
                start: "MSPointerDown",
                move: "MSPointerMove",
                end: "MSPointerUp"
            } : {
                start: "mousedown touchstart",
                move: "mousemove touchmove",
                end: "mouseup touchend"
            },
            F = window.CSS && CSS.supports && CSS.supports("touch-action", "none") && function() {
                var e = !1;
                try {
                    var t = Object.defineProperty({}, "passive", {
                        get: function() {
                            e = !0
                        }
                    });
                    window.addEventListener("test", null, t)
                } catch (e) {}
                return e
            }(),
            _ = e,
            z = [],
            W = [],
            R = 0,
            U = d.spectrum,
            B = [],
            V = {},
            X = e.ownerDocument,
            Y = X.documentElement,
            K = X.body,
            Q = "rtl" === X.dir || 1 === d.ort ? 0 : 100;
        return te(q = _, d.cssClasses.target), 0 === d.dir ? te(q, d.cssClasses.ltr) : te(q, d.cssClasses.rtl), 0 === d.ort ? te(q, d.cssClasses.horizontal) : te(q, d.cssClasses.vertical), O = p(q, d.cssClasses.base),
            function(e, t) {
                var n, i, o, r = p(t, d.cssClasses.connects);
                D = [], (j = []).push(a(r, e[0]));
                for (var s = 0; s < d.handles; s++) D.push((n = s, o = void 0, i = p(t, d.cssClasses.origin), (o = p(i, d.cssClasses.handle)).setAttribute("data-handle", n), o.setAttribute("tabindex", "0"), o.setAttribute("role", "slider"), o.setAttribute("aria-orientation", d.ort ? "vertical" : "horizontal"), 0 === n ? te(o, d.cssClasses.handleLower) : n === d.handles - 1 && te(o, d.cssClasses.handleUpper), i)), W[s] = s, j.push(a(r, e[s + 1]))
            }(d.connect, O), (M = d.events).fixed || D.forEach(function(e, t) {
                f(I.start, e.children[0], y, {
                    handleNumbers: [t]
                })
            }), M.tap && f(I.start, O, n, {}), M.hover && f(I.move, O, i, {
                hover: !0
            }), M.drag && j.forEach(function(e, t) {
                if (!1 !== e && 0 !== t && t !== j.length - 1) {
                    var n = D[t - 1],
                        i = D[t],
                        o = [e];
                    te(e, d.cssClasses.draggable), M.fixed && (o.push(n.children[0]), o.push(i.children[0])), o.forEach(function(e) {
                        f(I.start, e, y, {
                            handles: [n, i],
                            handleNumbers: [t - 1, t]
                        })
                    })
                }
            }), $(d.start), L = {
                destroy: function() {
                    for (var e in d.cssClasses) d.cssClasses.hasOwnProperty(e) && ne(_, d.cssClasses[e]);
                    for (; _.firstChild;) _.removeChild(_.firstChild);
                    delete _.noUiSlider
                },
                steps: function() {
                    return z.map(function(e, t) {
                        var n = U.getNearbySteps(e),
                            i = B[t],
                            o = n.thisStep.step,
                            r = null;
                        !1 !== o && i + o > n.stepAfter.startValue && (o = n.stepAfter.startValue - i), r = i > n.thisStep.startValue ? n.thisStep.step : !1 !== n.stepBefore.step && i - n.stepBefore.highestStep, 100 === e ? o = null : 0 === e && (r = null);
                        var s = U.countStepDecimals();
                        return null !== o && !1 !== o && (o = Number(o.toFixed(s))), null !== r && !1 !== r && (r = Number(r.toFixed(s))), [r, o]
                    })
                },
                on: o,
                off: function(e) {
                    var i = e && e.split(".")[0],
                        o = i && e.substring(i.length);
                    Object.keys(V).forEach(function(e) {
                        var t = e.split(".")[0],
                            n = e.substring(t.length);
                        i && i !== t || o && o !== n || delete V[e]
                    })
                },
                get: N,
                set: $,
                reset: function(e) {
                    $(d.start, e)
                },
                __moveHandles: function(e, t, n) {
                    S(e, t, z, n)
                },
                options: r,
                updateOptions: function(t, e) {
                    var n = N(),
                        i = ["margin", "limit", "padding", "range", "animate", "snap", "step", "format"];
                    i.forEach(function(e) {
                        void 0 !== t[e] && (r[e] = t[e])
                    });
                    var o = oe(r);
                    i.forEach(function(e) {
                        void 0 !== t[e] && (d[e] = o[e])
                    }), U = o.spectrum, d.margin = o.margin, d.limit = o.limit, d.padding = o.padding, d.pips && s(d.pips), z = [], $(t.start || n, e)
                },
                target: _,
                removePips: u,
                pips: s
            }, d.pips && s(d.pips), d.tooltips && (H = D.map(t), o("update", function(e, t, n) {
                if (H[t]) {
                    var i = e[t];
                    !0 !== d.tooltips[t] && (i = d.tooltips[t].to(n[t])), H[t].innerHTML = i
                }
            })), o("update", function(e, t, s, n, a) {
                W.forEach(function(e) {
                    var t = D[e],
                        n = x(z, e, 0, !0, !0, !0),
                        i = x(z, e, 100, !0, !0, !0),
                        o = a[e],
                        r = d.ariaFormat.to(s[e]);
                    t.children[0].setAttribute("aria-valuemin", n.toFixed(1)), t.children[0].setAttribute("aria-valuemax", i.toFixed(1)), t.children[0].setAttribute("aria-valuenow", o.toFixed(1)), t.children[0].setAttribute("aria-valuetext", r)
                })
            }), L
    }
    var re = "11.1.0";
    l.prototype.getMargin = function(e) {
        var t = this.xNumSteps[0];
        if (t && e / t % 1 != 0) throw new Error("noUiSlider (" + re + "): 'limit', 'margin' and 'padding' must be divisible by step.");
        return 2 === this.xPct.length && d(this.xVal, e)
    }, l.prototype.toStepping = function(e) {
        return n(this.xVal, this.xPct, e)
    }, l.prototype.fromStepping = function(e) {
        return function(e, t, n) {
            if (100 <= n) return e.slice(-1)[0];
            var i, o = p(n, t),
                r = e[o - 1],
                s = e[o],
                a = t[o - 1];
            return i = [r, s], (n - a) * u(a, t[o]) * (i[1] - i[0]) / 100 + i[0]
        }(this.xVal, this.xPct, e)
    }, l.prototype.getStep = function(e) {
        return i(this.xPct, this.xSteps, this.snap, e)
    }, l.prototype.getNearbySteps = function(e) {
        var t = p(e, this.xPct);
        return {
            stepBefore: {
                startValue: this.xVal[t - 2],
                step: this.xNumSteps[t - 2],
                highestStep: this.xHighestCompleteStep[t - 2]
            },
            thisStep: {
                startValue: this.xVal[t - 1],
                step: this.xNumSteps[t - 1],
                highestStep: this.xHighestCompleteStep[t - 1]
            },
            stepAfter: {
                startValue: this.xVal[t - 0],
                step: this.xNumSteps[t - 0],
                highestStep: this.xHighestCompleteStep[t - 0]
            }
        }
    }, l.prototype.countStepDecimals = function() {
        var e = this.xNumSteps.map(t);
        return Math.max.apply(null, e)
    }, l.prototype.convert = function(e) {
        return this.getStep(this.toStepping(e))
    };
    var j = {
        to: function(e) {
            return void 0 !== e && e.toFixed(2)
        },
        from: Number
    };
    return {
        version: re,
        create: function(e, t) {
            if (!e || !e.nodeName) throw new Error("noUiSlider (" + re + "): create requires a single element, got: " + e);
            if (e.noUiSlider) throw new Error("noUiSlider (" + re + "): Slider was already initialized.");
            var n = D(e, oe(t), t);
            return e.noUiSlider = n
        }
    }
}),
function(e) {
    "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? module.exports = e() : window.wNumb = e()
}(function() {
    "use strict";
    var r = ["decimals", "thousand", "mark", "prefix", "suffix", "encoder", "decoder", "negativeBefore", "negative", "edit", "undo"];

    function w(e) {
        return e.split("").reverse().join("")
    }

    function g(e, t) {
        return e.substring(0, t.length) === t
    }

    function s(e, t, n) {
        if ((e[t] || e[n]) && e[t] === e[n]) throw new Error(t)
    }

    function x(e) {
        return "number" == typeof e && isFinite(e)
    }

    function n(e, t, n, i, o, r, s, a, l, c, u, d) {
        var p, f, h, g, m, v = d,
            y = "",
            b = "";
        return r && (d = r(d)), !!x(d) && (!1 !== e && 0 === parseFloat(d.toFixed(e)) && (d = 0), d < 0 && (p = !0, d = Math.abs(d)), !1 !== e && (m = e, g = (g = d).toString().split("e"), d = (+((g = (g = Math.round(+(g[0] + "e" + (g[1] ? +g[1] + m : m)))).toString().split("e"))[0] + "e" + (g[1] ? +g[1] - m : -m))).toFixed(m)), -1 !== (d = d.toString()).indexOf(".") ? (h = (f = d.split("."))[0], n && (y = n + f[1])) : h = d, t && (h = w((h = w(h).match(/.{1,3}/g)).join(w(t)))), p && a && (b += a), i && (b += i), p && l && (b += l), b += h, b += y, o && (b += o), c && (b = c(b, v)), b)
    }

    function i(e, t, n, i, o, r, s, a, l, c, u, d) {
        var p, f, h = "";
        return u && (d = u(d)), !(!d || "string" != typeof d) && (a && g(d, a) && (d = d.replace(a, ""), p = !0), i && g(d, i) && (d = d.replace(i, "")), l && g(d, l) && (d = d.replace(l, ""), p = !0), o && (f = o, d.slice(-1 * f.length) === f) && (d = d.slice(0, -1 * o.length)), t && (d = d.split(t).join("")), n && (d = d.replace(n, ".")), p && (h += "-"), "" !== (h = (h += d).replace(/[^0-9\.\-.]/g, "")) && (h = Number(h), s && (h = s(h)), !!x(h) && h))
    }

    function o(e, t, n) {
        var i, o = [];
        for (i = 0; i < r.length; i += 1) o.push(e[r[i]]);
        return o.push(n), t.apply("", o)
    }
    return function e(t) {
        if (!(this instanceof e)) return new e(t);
        "object" == typeof t && (t = function(e) {
            var t, n, i, o = {};
            for (void 0 === e.suffix && (e.suffix = e.postfix), t = 0; t < r.length; t += 1)
                if (void 0 === (i = e[n = r[t]])) "negative" !== n || o.negativeBefore ? "mark" === n && "." !== o.thousand ? o[n] = "." : o[n] = !1 : o[n] = "-";
                else if ("decimals" === n) {
                if (!(0 <= i && i < 8)) throw new Error(n);
                o[n] = i
            } else if ("encoder" === n || "decoder" === n || "edit" === n || "undo" === n) {
                if ("function" != typeof i) throw new Error(n);
                o[n] = i
            } else {
                if ("string" != typeof i) throw new Error(n);
                o[n] = i
            }
            return s(o, "mark", "thousand"), s(o, "prefix", "negative"), s(o, "prefix", "negativeBefore"), o
        }(t), this.to = function(e) {
            return o(t, n, e)
        }, this.from = function(e) {
            return o(t, i, e)
        })
    }
}),
function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? e(require("jquery")) : e(jQuery)
}(function(T) {
    var i, e = navigator.userAgent,
        C = /iphone/i.test(e),
        o = /chrome/i.test(e),
        E = /android/i.test(e);
    T.mask = {
        definitions: {
            9: "[0-9]",
            a: "[A-Za-z]",
            "*": "[A-Za-z0-9]"
        },
        autoclear: !0,
        dataName: "rawMaskFn",
        placeholder: "_"
    }, T.fn.extend({
        caret: function(e, t) {
            var n;
            if (0 !== this.length && !this.is(":hidden") && this.get(0) === document.activeElement) return "number" == typeof e ? (t = "number" == typeof t ? t : e, this.each(function() {
                this.setSelectionRange ? this.setSelectionRange(e, t) : this.createTextRange && ((n = this.createTextRange()).collapse(!0), n.moveEnd("character", t), n.moveStart("character", e), n.select())
            })) : (this[0].setSelectionRange ? (e = this[0].selectionStart, t = this[0].selectionEnd) : document.selection && document.selection.createRange && (n = document.selection.createRange(), e = 0 - n.duplicate().moveStart("character", -1e5), t = e + n.text.length), {
                begin: e,
                end: t
            })
        },
        unmask: function() {
            return this.trigger("unmask")
        },
        mask: function(t, v) {
            var n, y, b, w, x, k, S;
            if (!t && 0 < this.length) {
                var e = T(this[0]).data(T.mask.dataName);
                return e ? e() : void 0
            }
            return v = T.extend({
                autoclear: T.mask.autoclear,
                placeholder: T.mask.placeholder,
                completed: null
            }, v), n = T.mask.definitions, y = [], b = k = t.length, w = null, t = String(t), T.each(t.split(""), function(e, t) {
                "?" == t ? (k--, b = e) : n[t] ? (y.push(new RegExp(n[t])), null === w && (w = y.length - 1), e < b && (x = y.length - 1)) : y.push(null)
            }), this.trigger("unmask").each(function() {
                var s = T(this),
                    a = T.map(t.split(""), function(e, t) {
                        if ("?" != e) return n[e] ? u(t) : e
                    }),
                    l = a.join(""),
                    r = s.val();

                function c() {
                    if (v.completed) {
                        for (var e = w; e <= x; e++)
                            if (y[e] && a[e] === u(e)) return;
                        v.completed.call(s)
                    }
                }

                function u(e) {
                    return e < v.placeholder.length ? v.placeholder.charAt(e) : v.placeholder.charAt(0)
                }

                function d(e) {
                    for (; ++e < k && !y[e];);
                    return e
                }

                function p(e, t) {
                    var n, i;
                    if (!(e < 0)) {
                        for (n = e, i = d(t); n < k; n++)
                            if (y[n]) {
                                if (!(i < k && y[n].test(a[i]))) break;
                                a[n] = a[i], a[i] = u(i), i = d(i)
                            }
                        g(), s.caret(Math.max(w, e))
                    }
                }

                function f(e) {
                    m(), s.val() != r && s.change()
                }

                function h(e, t) {
                    var n;
                    for (n = e; n < t && n < k; n++) y[n] && (a[n] = u(n))
                }

                function g() {
                    s.val(a.join(""))
                }

                function m(e) {
                    var t, n, i, o = s.val(),
                        r = -1;
                    for (i = t = 0; t < k; t++)
                        if (y[t]) {
                            for (a[t] = u(t); i++ < o.length;)
                                if (n = o.charAt(i - 1), y[t].test(n)) {
                                    a[t] = n, r = t;
                                    break
                                }
                            if (i > o.length) {
                                h(t + 1, k);
                                break
                            }
                        } else a[t] === o.charAt(i) && i++, t < b && (r = t);
                    return e ? g() : r + 1 < b ? v.autoclear || a.join("") === l ? (s.val() && s.val(""), h(0, k)) : g() : (g(), s.val(s.val().substring(0, r + 1))), b ? t : w
                }
                s.data(T.mask.dataName, function() {
                    return T.map(a, function(e, t) {
                        return y[t] && e != u(t) ? e : null
                    }).join("")
                }), s.one("unmask", function() {
                    s.off(".mask").removeData(T.mask.dataName)
                }).on("focus.mask", function() {
                    var e;
                    s.prop("readonly") || (clearTimeout(i), r = s.val(), e = m(), i = setTimeout(function() {
                        s.get(0) === document.activeElement && (g(), e == t.replace("?", "").length ? s.caret(0, e) : s.caret(e))
                    }, 10))
                }).on("blur.mask", f).on("keydown.mask", function(e) {
                    if (!s.prop("readonly")) {
                        var t, n, i, o = e.which || e.keyCode;
                        S = s.val(), 8 === o || 46 === o || C && 127 === o ? (n = (t = s.caret()).begin, (i = t.end) - n == 0 && (n = 46 !== o ? function(e) {
                            for (; 0 <= --e && !y[e];);
                            return e
                        }(n) : i = d(n - 1), i = 46 === o ? d(i) : i), h(n, i), p(n, i - 1), e.preventDefault()) : 13 === o ? f.call(this, e) : 27 === o && (s.val(r), s.caret(0, m()), e.preventDefault())
                    }
                }).on("keypress.mask", function(e) {
                    if (!s.prop("readonly")) {
                        var t, n, i, o = e.which || e.keyCode,
                            r = s.caret();
                        e.ctrlKey || e.altKey || e.metaKey || o < 32 || !o || 13 === o || (r.end - r.begin != 0 && (h(r.begin, r.end), p(r.begin, r.end - 1)), (t = d(r.begin - 1)) < k && (n = String.fromCharCode(o), y[t].test(n)) && (function(e) {
                            var t, n, i, o;
                            for (n = u(t = e); t < k; t++)
                                if (y[t]) {
                                    if (i = d(t), o = a[t], a[t] = n, !(i < k && y[i].test(o))) break;
                                    n = o
                                }
                        }(t), a[t] = n, g(), i = d(t), E ? setTimeout(function() {
                            T.proxy(T.fn.caret, s, i)()
                        }, 0) : s.caret(i), r.begin <= x && c()), e.preventDefault())
                    }
                }).on("input.mask paste.mask", function() {
                    s.prop("readonly") || setTimeout(function() {
                        var e = m(!0);
                        s.caret(e), c()
                    }, 0)
                }), o && E && s.off("input.mask").on("input.mask", function(e) {
                    var t = s.val(),
                        n = s.caret();
                    if (S && S.length && S.length > t.length) {
                        for (m(!0); 0 < n.begin && !y[n.begin - 1];) n.begin--;
                        if (0 === n.begin)
                            for (; n.begin < w && !y[n.begin];) n.begin++;
                        s.caret(n.begin, n.begin)
                    } else {
                        m(!0);
                        var i = t.charAt(n.begin);
                        n.begin < k && (y[n.begin] || n.begin++, y[n.begin].test(i) && n.begin++), s.caret(n.begin, n.begin)
                    }
                    c()
                }), m()
            })
        }
    })
}),
function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : e.MicroModal = t()
}(this, function() {
    "use strict";
    var e, c, i, o, u, t = function() {
            function i(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var i = t[n];
                    i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
                }
            }
            return function(e, t, n) {
                return t && i(e.prototype, t), n && i(e, n), e
            }
        }(),
        x = function(e) {
            if (Array.isArray(e)) {
                for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t];
                return n
            }
            return Array.from(e)
        };
    return e = ["a[href]", "area[href]", 'input:not([disabled]):not([type="hidden"]):not([aria-hidden])', "select:not([disabled]):not([aria-hidden])", "textarea:not([disabled]):not([aria-hidden])", "button:not([disabled]):not([aria-hidden])", "iframe", "object", "embed", "[contenteditable]", '[tabindex]:not([tabindex^="-"])'], c = function() {
        function w(e) {
            var t = e.targetModal,
                n = e.triggers,
                i = void 0 === n ? [] : n,
                o = e.onShow,
                r = void 0 === o ? function() {} : o,
                s = e.onClose,
                a = void 0 === s ? function() {} : s,
                l = e.openTrigger,
                c = void 0 === l ? "data-micromodal-trigger" : l,
                u = e.closeTrigger,
                d = void 0 === u ? "data-micromodal-close" : u,
                p = e.disableScroll,
                f = void 0 !== p && p,
                h = e.disableFocus,
                g = void 0 !== h && h,
                m = e.awaitCloseAnimation,
                v = void 0 !== m && m,
                y = e.debugMode,
                b = void 0 !== y && y;
            (function(e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            })(this, w), this.modal = document.getElementById(t), this.config = {
                debugMode: b,
                disableScroll: f,
                openTrigger: c,
                closeTrigger: d,
                onShow: r,
                onClose: a,
                awaitCloseAnimation: v,
                disableFocus: g
            }, 0 < i.length && this.registerTriggers.apply(this, x(i)), this.onClick = this.onClick.bind(this), this.onKeydown = this.onKeydown.bind(this)
        }
        return t(w, [{
            key: "registerTriggers",
            value: function() {
                for (var t = this, e = arguments.length, n = Array(e), i = 0; i < e; i++) n[i] = arguments[i];
                n.forEach(function(e) {
                    e.addEventListener("click", function() {
                        return t.showModal()
                    })
                })
            }
        }, {
            key: "showModal",
            value: function() {
                this.activeElement = document.activeElement, this.modal.setAttribute("aria-hidden", "false"), this.modal.classList.add("is-open"), this.setFocusToFirstNode(), this.scrollBehaviour("disable"), this.addEventListeners(), this.config.onShow(this.modal)
            }
        }, {
            key: "closeModal",
            value: function() {
                var t = this.modal;
                this.modal.setAttribute("aria-hidden", "true"), this.removeEventListeners(), this.scrollBehaviour("enable"), this.activeElement.focus(), this.config.onClose(this.modal), this.config.awaitCloseAnimation ? this.modal.addEventListener("animationend", function e() {
                    t.classList.remove("is-open"), t.removeEventListener("animationend", e, !1)
                }, !1) : t.classList.remove("is-open")
            }
        }, {
            key: "scrollBehaviour",
            value: function(e) {
                if (this.config.disableScroll) {
                    var t = document.querySelector("body");
                    switch (e) {
                        case "enable":
                            Object.assign(t.style, {
                                overflow: "initial",
                                height: "initial"
                            });
                            break;
                        case "disable":
                            Object.assign(t.style, {
                                overflow: "hidden",
                                height: "100vh"
                            })
                    }
                }
            }
        }, {
            key: "addEventListeners",
            value: function() {
                this.modal.addEventListener("touchstart", this.onClick), this.modal.addEventListener("click", this.onClick), document.addEventListener("keydown", this.onKeydown)
            }
        }, {
            key: "removeEventListeners",
            value: function() {
                this.modal.removeEventListener("touchstart", this.onClick), this.modal.removeEventListener("click", this.onClick), document.removeEventListener("keydown", this.onKeydown)
            }
        }, {
            key: "onClick",
            value: function(e) {
                e.target.hasAttribute(this.config.closeTrigger) && (this.closeModal(), e.preventDefault())
            }
        }, {
            key: "onKeydown",
            value: function(e) {
                27 === e.keyCode && this.closeModal(e), 9 === e.keyCode && this.maintainFocus(e)
            }
        }, {
            key: "getFocusableNodes",
            value: function() {
                var t = this.modal.querySelectorAll(e);
                return Object.keys(t).map(function(e) {
                    return t[e]
                })
            }
        }, {
            key: "setFocusToFirstNode",
            value: function() {
                if (!this.config.disableFocus) {
                    var e = this.getFocusableNodes();
                    e.length && e[0].focus()
                }
            }
        }, {
            key: "maintainFocus",
            value: function(e) {
                var t = this.getFocusableNodes();
                if (this.modal.contains(document.activeElement)) {
                    var n = t.indexOf(document.activeElement);
                    e.shiftKey && 0 === n && (t[t.length - 1].focus(), e.preventDefault()), e.shiftKey || n !== t.length - 1 || (t[0].focus(), e.preventDefault())
                } else t[0].focus()
            }
        }]), w
    }(), i = null, o = function(e) {
        if (!document.getElementById(e)) return console.warn("MicroModal v0.3.1: ???Seems like you have missed %c'" + e + "'", "background-color: #f8f9fa;color: #50596c;font-weight: bold;", "ID somewhere in your code. Refer example below to resolve it."), console.warn("%cExample:", "background-color: #f8f9fa;color: #50596c;font-weight: bold;", '<div class="modal" id="' + e + '"></div>'), !1
    }, u = function(e, t) {
        if (function(e) {
                if (e.length <= 0) console.warn("MicroModal v0.3.1: ???Please specify at least one %c'micromodal-trigger'", "background-color: #f8f9fa;color: #50596c;font-weight: bold;", "data attribute."), console.warn("%cExample:", "background-color: #f8f9fa;color: #50596c;font-weight: bold;", '<a href="#" data-micromodal-trigger="my-modal"></a>')
            }(e), !t) return !0;
        for (var n in t) o(n);
        return !0
    }, {
        init: function(e) {
            var t, n, i, o = Object.assign({}, {
                    openTrigger: "data-micromodal-trigger"
                }, e),
                r = [].concat(x(document.querySelectorAll("[" + o.openTrigger + "]"))),
                s = (t = r, n = o.openTrigger, i = [], t.forEach(function(e) {
                    var t = e.attributes[n].value;
                    void 0 === i[t] && (i[t] = []), i[t].push(e)
                }), i);
            if (!0 !== o.debugMode || !1 !== u(r, s))
                for (var a in s) {
                    var l = s[a];
                    o.targetModal = a, o.triggers = [].concat(x(l)), new c(o)
                }
        },
        show: function(e, t) {
            var n = t || {};
            n.targetModal = e, !0 === n.debugMode && !1 === o(e) || (i = new c(n)).showModal()
        },
        close: function() {
            i.closeModal()
        }
    }
});