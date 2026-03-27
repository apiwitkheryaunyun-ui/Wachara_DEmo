<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>&#9733; StockMaster Pro 2000 &#8482; &#9733;</title>
<style>
/* ===========================================
   STOCKMASTER PRO 2000 ™
   Y2K / Windows XP Classic Style
   =========================================== */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%;overflow:hidden}
body{
  font-family:Tahoma,'MS Sans Serif',Verdana,Arial,sans-serif;
  font-size:11px;color:#000;
  background:#1E4D9E;
  background-image:radial-gradient(ellipse at 30% 20%,#2A62B8 0%,#163D96 60%,#0E2F7A 100%);
}

/* ====== LOGIN SCREEN ====== */
#login-screen{
  position:fixed;inset:0;
  display:flex;align-items:center;justify-content:center;
  background:radial-gradient(ellipse at 20% 20%,#2E66BF 0%,#164091 58%,#0D2D76 100%);
  z-index:2000;
}
.login-window{
  width:min(92vw,460px);
  border:2px solid;border-color:#FEFEFE #606060 #606060 #FEFEFE;
  background:#ECE9D8;
  box-shadow:6px 6px 20px rgba(0,0,0,.65);
}
.login-title{
  background:linear-gradient(180deg,#255CCC 0%,#3E81F5 18%,#2860D5 52%,#1145B0 100%);
  color:#FFF;padding:7px 10px;font-size:12px;font-weight:bold;
  text-shadow:1px 1px 2px rgba(0,0,48,.5);
}
.login-body{padding:14px}
.login-h{font-size:13px;font-weight:bold;color:#002D86;margin-bottom:3px}
.login-p{font-size:11px;color:#444;margin-bottom:12px;line-height:1.4}
.login-grid{display:grid;grid-template-columns:1fr;gap:8px}
.hint-box{
  margin-top:10px;padding:8px;border:1px solid #B3AF9F;
  background:#F7F3E7;font-size:10px;color:#555;line-height:1.5;
}

/* ====== APP WINDOW ====== */
#app{
  position:fixed;inset:7px;
  display:flex;flex-direction:column;
  background:#ECE9D8;
  border:2px solid;border-color:#FEFEFE #606060 #606060 #FEFEFE;
  box-shadow:4px 4px 18px rgba(0,0,0,0.7);
}

/* ====== TITLEBAR ====== */
#titlebar{
  background:linear-gradient(180deg,#255CCC 0%,#3E81F5 18%,#2860D5 52%,#1145B0 100%);
  color:#FFF;display:flex;align-items:center;
  padding:3px 5px 3px 8px;height:30px;gap:6px;flex-shrink:0;cursor:default;
}
.ttitle{flex:1;font-size:12px;font-weight:bold;letter-spacing:.3px;text-shadow:1px 1px 2px rgba(0,0,48,.5);white-space:nowrap}
.wbtn{
  width:22px;height:20px;display:flex;align-items:center;justify-content:center;
  font-size:10px;font-weight:bold;cursor:pointer;flex-shrink:0;
  background:linear-gradient(180deg,#EEE9DF 0%,#D0CCB8 100%);
  border:1px solid;border-color:#FFF #707070 #707070 #FFF;color:#000;
}
.wbtn:hover{background:linear-gradient(180deg,#FFFEFC 0%,#E0DCCC 100%)}
.wbtn:active{border-color:#707070 #FFF #FFF #707070}
.wbtn.wclose{background:linear-gradient(180deg,#E85050 0%,#C82020 100%);border-color:#FF8888 #880000 #880000 #FF8888;color:#FFF;text-shadow:0 1px 1px rgba(0,0,0,.4)}
.wbtn.wclose:hover{background:linear-gradient(180deg,#FF6060 0%,#DD3030 100%)}

/* ====== MENUBAR ====== */
#menubar{
  background:linear-gradient(180deg,#F5F2E7 0%,#EBE7DA 100%);
  border-bottom:1px solid #B0ADA4;padding:2px 6px;
  display:flex;gap:2px;flex-shrink:0;
}
.mbtn{
  padding:2px 8px;font-size:11px;cursor:default;
  border:1px solid transparent;font-family:inherit;background:transparent;color:#000;
}
.mbtn:hover{background:#1C5CC7;color:#FFF;border-color:transparent}

/* ====== TOOLBAR ====== */
#toolbar{
  background:linear-gradient(180deg,#F8F5EE 0%,#E8E4D5 100%);
  border-bottom:2px solid;border-color:#ACA899 #FFF #FFF #ACA899;
  padding:3px 8px;display:flex;align-items:center;gap:3px;flex-shrink:0;
}
.tbtn{
  display:inline-flex;flex-direction:column;align-items:center;gap:1px;
  padding:3px 10px;border:1px solid transparent;cursor:pointer;
  font-family:inherit;font-size:10px;background:transparent;color:#000;min-width:56px;
}
.tbtn:hover{border-color:#DDD9CC #9A9890 #9A9890 #DDD9CC;background:#EDE9DC}
.tbtn:active,.tbtn.tactive{border-color:#9A9890 #DDD9CC #DDD9CC #9A9890;background:#D8D4C8}
.tbtn .ticon{font-size:22px;line-height:1}
.tbtn .tlbl{white-space:nowrap;font-size:10px}
.tsep{width:2px;height:36px;background:#9A9890;border-right:1px solid #FFF;margin:0 4px;flex-shrink:0}

/* ====== LAYOUT ====== */
#layout{flex:1;display:flex;overflow:hidden}

/* ====== SIDEBAR ====== */
#sidebar{
  width:192px;flex-shrink:0;
  background:linear-gradient(180deg,#E8E4D8 0%,#DDD9CC 100%);
  border-right:2px solid;border-color:#FFF #ACA899 #ACA899 #FFF;
  overflow-y:auto;overflow-x:hidden;
}
.sb-hdr{
  background:linear-gradient(90deg,#1C5CC7 0%,#3A7FE8 60%,#2266D8 100%);
  color:#FFF;padding:5px 10px;font-size:11px;font-weight:bold;
  text-shadow:1px 1px 1px rgba(0,0,0,.4);letter-spacing:.4px;margin-bottom:3px;
}
.sb-grp-title{font-size:10px;font-weight:bold;color:#444;padding:5px 8px 2px 8px;text-transform:uppercase;letter-spacing:.8px;cursor:default}
.nav-item{
  display:flex;align-items:center;gap:6px;
  padding:4px 6px 4px 14px;font-size:11px;cursor:pointer;
  color:#000;border:1px solid transparent;user-select:none;
}
.nav-item:hover{background:#C8DDF8;border-color:#5588CC #3366AA #3366AA #5588CC}
.nav-item.active{background:#B0CBF5;border-color:#3366AA #5588CC #5588CC #3366AA;font-weight:bold;color:#001A66}
.nav-item .ni{font-size:14px;width:18px;text-align:center}
.sb-div{height:1px;background:#ACA899;margin:5px 8px;border-bottom:1px solid #FFF}

/* ====== MAIN CONTENT ====== */
#main{flex:1;overflow:auto;background:#FFF;position:relative}
.view{display:none;min-height:100%}.view.active{display:block}

/* ====== PAGE HEADER ====== */
.phdr{
  background:linear-gradient(180deg,#1C5CC7 0%,#2466D5 70%,#1C5CC7 100%);
  color:#FFF;padding:8px 14px;display:flex;align-items:center;gap:8px;
  position:sticky;top:0;z-index:10;
}
.phdr h1{font-size:14px;font-weight:bold;text-shadow:1px 1px 2px rgba(0,0,0,.4);flex:1}
.phdr .phi{font-size:22px}
.phdr .pha{display:flex;gap:5px}
.vbody{padding:12px}

/* ====== STAT CARDS ====== */
.sgrid{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-bottom:14px}
.scard{border:2px solid;overflow:hidden}
.scard.cb{border-color:#4477CC #0033AA #0033AA #4477CC}
.scard.cg{border-color:#44AA44 #007700 #007700 #44AA44}
.scard.co{border-color:#DDAA33 #AA7700 #AA7700 #DDAA33}
.scard.cr{border-color:#DD4444 #AA0000 #AA0000 #DD4444}
.sc-h{padding:4px 10px;font-size:11px;font-weight:bold;color:#FFF;text-shadow:1px 1px 1px rgba(0,0,0,.3)}
.scard.cb .sc-h{background:linear-gradient(90deg,#1C5CC7,#3A7FE8)}
.scard.cg .sc-h{background:linear-gradient(90deg,#1A7A1A,#2EBB2E)}
.scard.co .sc-h{background:linear-gradient(90deg,#AA7700,#DD9900)}
.scard.cr .sc-h{background:linear-gradient(90deg,#AA1111,#DD3333)}
.sc-b{background:#FFF;padding:10px 12px;display:flex;justify-content:space-between;align-items:center}
.sc-v{font-size:28px;font-weight:bold;font-family:'Courier New',monospace;line-height:1}
.scard.cb .sc-v{color:#003399}.scard.cg .sc-v{color:#006600}
.scard.co .sc-v{color:#885500}.scard.cr .sc-v{color:#880000}
.sc-ico{font-size:32px;opacity:.3}
.sc-sub{font-size:10px;color:#666}

/* ====== PANEL ====== */
.panel{border:2px solid;border-color:#808080 #FFF #FFF #808080;margin-bottom:12px;background:#F5F2E8}
.ptitle{
  background:linear-gradient(180deg,#EEE9DC 0%,#D8D4C8 100%);
  border-bottom:1px solid #B0ADA4;padding:4px 10px;font-size:11px;
  font-weight:bold;display:flex;align-items:center;gap:6px;cursor:default;
}
.pbody{padding:10px}

/* ====== TABLE ====== */
.twrap{border:2px solid;border-color:#606060 #FFF #FFF #606060;overflow:auto}
table.dt{width:100%;border-collapse:collapse;font-size:11px}
table.dt th{
  background:linear-gradient(180deg,#1C5CC7 0%,#1044B0 100%);
  color:#FFF;padding:5px 9px;text-align:left;
  border-right:1px solid rgba(255,255,255,.3);white-space:nowrap;
  text-shadow:0 1px 1px rgba(0,0,0,.3);cursor:default;
}
table.dt th:last-child{border-right:none}
table.dt td{padding:4px 9px;border-bottom:1px solid #D8D4CC;border-right:1px solid #E8E4DC;vertical-align:middle}
table.dt td:last-child{border-right:none}
table.dt tr:nth-child(even){background:#F0F5FF}
table.dt tr:hover{background:#C8DCF8!important;cursor:default}

/* ====== BADGES ====== */
.badge{display:inline-block;padding:1px 7px;border:1px solid;font-size:10px;font-weight:bold;white-space:nowrap}
.bog{background:#CCFFCC;border-color:#007700;color:#005500}
.bow{background:#FFF5CC;border-color:#CC8800;color:#885500}
.bor{background:#FFCCCC;border-color:#CC0000;color:#880000}
.boi{background:#CCE5FF;border-color:#0055CC;color:#003388}
.bogy{background:#E8E8E8;border-color:#808080;color:#404040}

/* ====== BUTTONS ====== */
.btn{
  display:inline-flex;align-items:center;gap:4px;
  padding:3px 14px;border:1px solid;cursor:pointer;
  font-family:inherit;font-size:11px;white-space:nowrap;text-decoration:none;
  background:linear-gradient(180deg,#EEE9DC 0%,#D4D0C4 100%);
  border-color:#FFF #808080 #808080 #FFF;color:#000;line-height:1.4;
}
.btn:hover{background:linear-gradient(180deg,#FFFEFC 0%,#E4E0D4 100%)}
.btn:active{border-color:#808080 #FFF #FFF #808080;background:#D4D0C4}
.btn-p{
  background:linear-gradient(180deg,#3A7FE8 0%,#1C5CC7 100%);
  border-color:#6DA0FF #0033AA #0033AA #6DA0FF;color:#FFF;
  text-shadow:0 1px 1px rgba(0,0,0,.3);
}
.btn-p:hover{background:linear-gradient(180deg,#4A8FFF 0%,#2C6CD7 100%)}
.btn-p:active{background:#1C5CC7;border-color:#2244AA #88AAFF #88AAFF #2244AA}
.btn-s{
  background:linear-gradient(180deg,#44BB44 0%,#228822 100%);
  border-color:#66DD66 #116611 #116611 #66DD66;color:#FFF;
  text-shadow:0 1px 1px rgba(0,0,0,.3);
}
.btn-s:hover{background:linear-gradient(180deg,#55CC55 0%,#339933 100%)}
.btn-w{
  background:linear-gradient(180deg,#FFBB33 0%,#CC8800 100%);
  border-color:#FFDD88 #996600 #996600 #FFDD88;color:#412200;
}
.btn-d{
  background:linear-gradient(180deg,#FF4444 0%,#CC0000 100%);
  border-color:#FF8888 #880000 #880000 #FF8888;color:#FFF;
  text-shadow:0 1px 1px rgba(0,0,0,.3);
}
.btn-d:hover{background:linear-gradient(180deg,#FF5555 0%,#DD1111 100%)}
.btn-sm{padding:2px 9px;font-size:10px}

/* ====== ACTION BAR ====== */
.abar{
  display:flex;align-items:center;gap:6px;
  padding:7px 10px;background:linear-gradient(180deg,#F5F2E8 0%,#EAE7DB 100%);
  border-bottom:1px solid #B0ADA4;flex-wrap:wrap;
}
.abar-right{display:flex;align-items:center;gap:4px;margin-left:auto}

/* ====== FORMS ====== */
.frow{display:grid;gap:10px;margin-bottom:10px}
.frow.c2{grid-template-columns:1fr 1fr}.frow.c3{grid-template-columns:1fr 1fr 1fr}.frow.c1{grid-template-columns:1fr}
.fgrp{display:flex;flex-direction:column;gap:3px}
.flbl{font-size:11px;font-weight:bold;color:#000066}
.fctl{
  border:1px solid;border-color:#808080 #DDDAD0 #DDDAD0 #808080;
  padding:3px 5px;font-family:inherit;font-size:11px;background:#FFF;color:#000;outline:none;width:100%;
}
.fctl:focus{border-color:#0055CC;outline:1px solid #88AAFF;outline-offset:-1px}
select.fctl{cursor:pointer}
textarea.fctl{resize:vertical;min-height:60px}

/* ====== MODAL ====== */
.mback{
  position:fixed;inset:0;background:rgba(0,0,0,.55);
  display:none;align-items:center;justify-content:center;z-index:999;
}
.mback.show{display:flex}
.mwin{
  background:#ECE9D8;border:2px solid;border-color:#FFF #606060 #606060 #FFF;
  outline:1px solid #303030;min-width:380px;max-width:680px;width:100%;
  max-height:88vh;display:flex;flex-direction:column;
  box-shadow:4px 4px 16px rgba(0,0,0,.6);
}
.mtb{
  background:linear-gradient(180deg,#255CCC 0%,#3E81F5 18%,#2860D5 60%,#1145B0 100%);
  color:#FFF;padding:4px 6px 3px 8px;display:flex;align-items:center;gap:6px;flex-shrink:0;cursor:default;
}
.mtb .mt{flex:1;font-size:12px;font-weight:bold;text-shadow:1px 1px 1px rgba(0,0,0,.4)}
.mbody{padding:14px;overflow-y:auto;flex:1}
.mfoot{
  padding:8px 14px;background:linear-gradient(180deg,#DDD9CC 0%,#CBC7BA 100%);
  border-top:1px solid #B0ADA4;display:flex;gap:6px;justify-content:flex-end;flex-shrink:0;
}

/* ====== INVOICE CREATE ====== */
.inv-tbl{width:100%;border-collapse:collapse;font-size:11px;margin-bottom:6px}
.inv-tbl th{
  background:linear-gradient(180deg,#1C5CC7 0%,#1044B0 100%);
  color:#FFF;padding:4px 8px;border-right:1px solid rgba(255,255,255,.2);text-align:left;font-size:10px;
}
.inv-tbl td{border:1px solid #D0CCC4;padding:3px 4px}
.inv-tbl tr:hover td{background:#F0F5FF}
.inv-tbl input,.inv-tbl select{
  border:1px solid #9898A0;padding:2px 4px;
  font-family:inherit;font-size:11px;background:#FFF;width:100%;
}
.inv-tbl input:focus,.inv-tbl select:focus{outline:1px solid #0055CC;border-color:#0055CC}
.totbox{float:right;min-width:220px;border:1px solid #808080;background:#F5F2E8;padding:8px;clear:right}
.trow{display:flex;justify-content:space-between;padding:2px 0;font-size:11px}
.trow.grand{border-top:2px solid #404040;margin-top:4px;padding-top:5px;font-weight:bold;font-size:14px;color:#001A66}

/* ====== INVOICE PRINT ====== */
.ivp{background:#FFF;max-width:720px;margin:0 auto;padding:20px;border:1px solid #808080}
.ivp-hdr{display:flex;justify-content:space-between;align-items:flex-start;padding-bottom:12px;border-bottom:3px double #003399;margin-bottom:14px}
.c-logo{font-size:22px;font-weight:bold;color:#003399;text-transform:uppercase;letter-spacing:1px}
.inv-no-box{border:2px solid #003399;padding:8px 14px;text-align:right}
.ivp-tbl{width:100%;border-collapse:collapse;font-size:11px;margin:12px 0}
.ivp-tbl th{background:#003399;color:#FFF;padding:5px 8px;text-align:left}
.ivp-tbl td{padding:4px 8px;border-bottom:1px solid #CCC}

/* ====== STATUS BAR ====== */
#statusbar{
  height:22px;background:linear-gradient(180deg,#DEDBD0 0%,#C8C5B8 100%);
  border-top:1px solid #ACA899;display:flex;align-items:center;
  padding:0 6px;gap:0;flex-shrink:0;overflow:hidden;
}
.sbp{
  border:1px solid;border-color:#808080 #FFF #FFF #808080;
  padding:1px 8px;font-size:10px;height:16px;display:flex;align-items:center;white-space:nowrap;margin-right:2px;
}
.sbp.fx{flex:1;overflow:hidden}
@keyframes sq{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.mqw{overflow:hidden;width:100%}
.mqi{display:inline-block;white-space:nowrap;animation:sq 30s linear infinite}

/* ====== UTILS ====== */
.clearfix::after{content:'';display:table;clear:both}
.tr{text-align:right}.tc{text-align:center}
.mb8{margin-bottom:8px}.mb12{margin-bottom:12px}.mt8{margin-top:8px}
.flex{display:flex}.fg{gap:8px}.ac{align-items:center}.jb{justify-content:space-between}
.row-low{color:#CC5500!important;font-weight:bold}
.row-out{color:#CC0000!important;font-weight:bold}
.row-ok{color:#006600}
.num{font-family:'Courier New',monospace}

/* Scrollbar */
::-webkit-scrollbar{width:16px;height:16px}
::-webkit-scrollbar-track{background:#D4D0C8;border:1px solid #C0BDB5}
::-webkit-scrollbar-thumb{
  background:linear-gradient(180deg,#DDD9CC 0%,#A8A59E 100%);
  border:1px solid;border-color:#FFF #808080 #808080 #FFF;
}
::-webkit-scrollbar-corner{background:#D4D0C8}
</style>
</head>
<body>

<!-- ========== APP WINDOW ========== -->
<div id="login-screen">
  <div class="login-window">
    <div class="login-title">เข้าสู่ระบบ - StockMaster Pro 2000</div>
    <div class="login-body">
      <div class="login-h">บริษัท วัชร สตีวีโดริ่ง จำกัด</div>
      <div class="login-p">ระบบจัดการสต็อกสินค้าและใบ Invoice</div>
      <form id="login-form" class="login-grid">
        <div class="fgrp">
          <label class="flbl">ชื่อผู้ใช้</label>
          <input type="text" class="fctl" id="login-username" placeholder="เช่น admin" required>
        </div>
        <div class="fgrp">
          <label class="flbl">รหัสผ่าน</label>
          <input type="password" class="fctl" id="login-password" placeholder="••••••••" required>
        </div>
        <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:4px">
          <button type="submit" class="btn btn-p">เข้าสู่ระบบ</button>
        </div>
      </form>
      <div class="hint-box">
        Demo User: admin / 1234<br>
        Demo User: stock / 1234
      </div>
      <div id="login-error" style="display:none;color:#A00000;font-size:10px;margin-top:8px"></div>
    </div>
  </div>
</div>

<div id="app" style="display:none">

  <!-- TITLEBAR -->
  <div id="titlebar">
    <span class="ttitle">&#128230; StockMaster Pro 2000 &#8482; &mdash; ระบบจัดการสต็อกสินค้าและใบ Invoice</span>
    <button class="wbtn" title="Minimize">&#x2012;</button>
    <button class="wbtn" title="Maximize">&#9633;</button>
    <button class="wbtn wclose" title="Close">&#10005;</button>
  </div>

  <!-- MENUBAR -->
  <div id="menubar">
    <button class="mbtn" onclick="openFileMenu()">ไฟล์(F)</button>
    <button class="mbtn" onclick="navigate('stock')">สต็อก(S)</button>
    <button class="mbtn" onclick="navigate('invoice')">Invoice(I)</button>
    <button class="mbtn" onclick="navigate('reports')">รายงาน(R)</button>
    <button class="mbtn" onclick="navigate('settings')">ตั้งค่า(T)</button>
    <button class="mbtn" onclick="logout()">ออกจากระบบ(L)</button>
    <button class="mbtn" onclick="openHelp()">ช่วยเหลือ(H)</button>
  </div>

  <!-- TOOLBAR -->
  <div id="toolbar">
    <button class="tbtn" onclick="navigate('dashboard')">
      <span class="ticon">&#127968;</span><span class="tlbl">หน้าหลัก</span>
    </button>
    <div class="tsep"></div>
    <button class="tbtn" onclick="navigate('stock')">
      <span class="ticon">&#128230;</span><span class="tlbl">สต็อกสินค้า</span>
    </button>
    <button class="tbtn" onclick="navigate('stock-in')">
      <span class="ticon">&#128229;</span><span class="tlbl">รับเข้าสต็อก</span>
    </button>
    <button class="tbtn" onclick="navigate('stock-out')">
      <span class="ticon">&#128228;</span><span class="tlbl">เบิกสินค้า</span>
    </button>
    <div class="tsep"></div>
    <button class="tbtn" onclick="navigate('invoice')">
      <span class="ticon">&#128220;</span><span class="tlbl">Invoice</span>
    </button>
    <button class="tbtn" onclick="navigate('invoice-create')">
      <span class="ticon">&#10133;</span><span class="tlbl">สร้าง Invoice</span>
    </button>
    <div class="tsep"></div>
    <button class="tbtn" onclick="printPage()">
      <span class="ticon">&#128424;</span><span class="tlbl">พิมพ์</span>
    </button>
  </div>

  <!-- MAIN LAYOUT -->
  <div id="layout">

    <!-- SIDEBAR -->
    <div id="sidebar">
      <div class="sb-hdr">&#9733; เมนูหลัก</div>

      <div class="sb-grp-title">ภาพรวม</div>
      <div class="nav-item active" onclick="navigate('dashboard')">
        <span class="ni">&#127968;</span> หน้าแรก (Dashboard)
      </div>

      <div class="sb-div"></div>
      <div class="sb-grp-title">จัดการสต็อก</div>
      <div class="nav-item" onclick="navigate('stock')">
        <span class="ni">&#128230;</span> รายการสินค้า
      </div>
      <div class="nav-item" onclick="openAddProduct()">
        <span class="ni">&#10133;</span> เพิ่มสินค้าใหม่
      </div>
      <div class="nav-item" onclick="navigate('stock-in')">
        <span class="ni">&#128229;</span> รับเข้าสต็อก
      </div>
      <div class="nav-item" onclick="navigate('stock-out')">
        <span class="ni">&#128228;</span> เบิกออกสต็อก
      </div>
      <div class="nav-item" onclick="navigate('stock-history')">
        <span class="ni">&#128202;</span> ประวัติการเคลื่อนไหว
      </div>

      <div class="sb-div"></div>
      <div class="sb-grp-title">ใบ Invoice</div>
      <div class="nav-item" onclick="navigate('invoice')">
        <span class="ni">&#128220;</span> รายการ Invoice
      </div>
      <div class="nav-item" onclick="navigate('invoice-create')">
        <span class="ni">&#10133;</span> สร้าง Invoice ใหม่
      </div>

      <div class="sb-div"></div>
      <div class="sb-grp-title">ระบบ</div>
      <div class="nav-item" onclick="navigate('settings')">
        <span class="ni">&#9881;</span> ตั้งค่าระบบ
      </div>
    </div>

    <!-- MAIN CONTENT -->
    <div id="main">

      <!-- ==================== DASHBOARD ==================== -->
      <div id="view-dashboard" class="view active">
        <div class="phdr">
          <span class="phi">&#127968;</span>
          <h1>หน้าแรก &mdash; ภาพรวมระบบ</h1>
          <div class="pha">
            <span style="font-size:10px;opacity:.8">อัปเดต: <span id="dash-time"></span></span>
          </div>
        </div>
        <div class="vbody">

          <!-- STAT CARDS -->
          <div class="sgrid" id="stat-cards"></div>

          <!-- ROW: Recent Stock + Low Stock Alert -->
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">

            <div class="panel">
              <div class="ptitle">&#128230; สินค้าที่เคลื่อนไหวล่าสุด</div>
              <div class="pbody" style="padding:0">
                <table class="dt" id="dash-recent-stock"></table>
              </div>
            </div>

            <div class="panel">
              <div class="ptitle" style="background:linear-gradient(180deg,#FFEECC 0%,#FFD8A0 100%)">&#9888; สินค้าใกล้หมด / หมดสต็อก</div>
              <div class="pbody" style="padding:0">
                <table class="dt" id="dash-lowstock"></table>
              </div>
            </div>

          </div>

          <!-- ROW: Recent Invoices -->
          <div class="panel mt8">
            <div class="ptitle">&#128220; Invoice ล่าสุด</div>
            <div class="pbody" style="padding:0">
              <table class="dt" id="dash-invoices"></table>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== STOCK LIST ==================== -->
      <div id="view-stock" class="view">
        <div class="phdr">
          <span class="phi">&#128230;</span>
          <h1>รายการสินค้าทั้งหมด</h1>
          <div class="pha">
            <button class="btn btn-s btn-sm" onclick="openAddProduct()">&#10133; เพิ่มสินค้าใหม่</button>
          </div>
        </div>
        <div class="vbody" style="padding:0">
          <div class="abar">
            <button class="btn btn-s btn-sm" onclick="openAddProduct()">&#10133; เพิ่มสินค้าใหม่</button>
            <button class="btn btn-sm" onclick="renderStock()">&#8635; รีเฟรช</button>
            <div class="abar-right">
              <label style="font-size:11px">หมวดหมู่:</label>
              <select class="fctl" style="width:130px" id="filter-cat" onchange="renderStock()">
                <option value="">ทั้งหมด</option>
              </select>
              <label style="font-size:11px">ค้นหา:</label>
              <input type="text" class="fctl" style="width:180px" id="stock-search" placeholder="ชื่อ / รหัสสินค้า..." oninput="renderStock()">
            </div>
          </div>
          <div class="twrap">
            <table class="dt" id="stock-table">
              <thead>
                <tr>
                  <th>รหัสสินค้า</th>
                  <th>ชื่อสินค้า</th>
                  <th>หมวดหมู่</th>
                  <th>หน่วย</th>
                  <th class="tr">สต็อกคงเหลือ</th>
                  <th class="tr">สต็อกขั้นต่ำ</th>
                  <th class="tr">ราคาซื้อ (฿)</th>
                  <th class="tr">ราคาขาย (฿)</th>
                  <th class="tc">สถานะ</th>
                  <th class="tc">จัดการ</th>
                </tr>
              </thead>
              <tbody id="stock-tbody"></tbody>
            </table>
          </div>
          <div class="abar" style="border-top:1px solid #B0ADA4;border-bottom:none">
            <span id="stock-count" style="font-size:10px;color:#555"></span>
          </div>
        </div>
      </div>

      <!-- ==================== STOCK IN ==================== -->
      <div id="view-stock-in" class="view">
        <div class="phdr">
          <span class="phi">&#128229;</span>
          <h1>รับสินค้าเข้าสต็อก</h1>
        </div>
        <div class="vbody">
          <div class="panel">
            <div class="ptitle">&#128229; บันทึกรับสินค้าเข้าคลัง</div>
            <div class="pbody">
              <div class="frow c2">
                <div class="fgrp">
                  <label class="flbl">สินค้า *</label>
                  <select class="fctl" id="si-product"></select>
                </div>
                <div class="fgrp">
                  <label class="flbl">วันที่รับ *</label>
                  <input type="date" class="fctl" id="si-date">
                </div>
              </div>
              <div class="frow c3">
                <div class="fgrp">
                  <label class="flbl">จำนวนที่รับ *</label>
                  <input type="number" class="fctl" id="si-qty" min="1" value="1">
                </div>
                <div class="fgrp">
                  <label class="flbl">ราคาซื้อต่อหน่วย (฿)</label>
                  <input type="number" class="fctl" id="si-price" min="0" step="0.01">
                </div>
                <div class="fgrp">
                  <label class="flbl">ผู้จัดจำหน่าย</label>
                  <input type="text" class="fctl" id="si-supplier" placeholder="ชื่อ supplier...">
                </div>
              </div>
              <div class="frow c1">
                <div class="fgrp">
                  <label class="flbl">หมายเหตุ</label>
                  <textarea class="fctl" id="si-note" rows="2" placeholder="หมายเหตุเพิ่มเติม..."></textarea>
                </div>
              </div>
              <div style="display:flex;gap:8px;margin-top:4px">
                <button class="btn btn-s" onclick="doStockIn()">&#128229; บันทึกรับสินค้า</button>
                <button class="btn" onclick="clearStockIn()">&#10006; ล้างข้อมูล</button>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="ptitle">&#128202; ประวัติรับเข้าล่าสุด</div>
            <div class="pbody" style="padding:0">
              <table class="dt">
                <thead><tr><th>วันที่</th><th>รหัสสินค้า</th><th>ชื่อสินค้า</th><th class="tr">จำนวน</th><th class="tr">ราคา/หน่วย</th><th>ผู้จัดจำหน่าย</th><th>หมายเหตุ</th></tr></thead>
                <tbody id="si-history"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- ==================== STOCK OUT ==================== -->
      <div id="view-stock-out" class="view">
        <div class="phdr">
          <span class="phi">&#128228;</span>
          <h1>เบิกสินค้าออกจากสต็อก</h1>
        </div>
        <div class="vbody">
          <div class="panel">
            <div class="ptitle">&#128228; บันทึกเบิกสินค้าออกจากคลัง</div>
            <div class="pbody">
              <div class="frow c2">
                <div class="fgrp">
                  <label class="flbl">สินค้า *</label>
                  <select class="fctl" id="so-product"></select>
                </div>
                <div class="fgrp">
                  <label class="flbl">วันที่เบิก *</label>
                  <input type="date" class="fctl" id="so-date">
                </div>
              </div>
              <div class="frow c3">
                <div class="fgrp">
                  <label class="flbl">จำนวนที่เบิก *</label>
                  <input type="number" class="fctl" id="so-qty" min="1" value="1">
                </div>
                <div class="fgrp">
                  <label class="flbl">ผู้เบิก</label>
                  <input type="text" class="fctl" id="so-requester" placeholder="ชื่อผู้เบิก...">
                </div>
                <div class="fgrp">
                  <label class="flbl">แผนก / วัตถุประสงค์</label>
                  <input type="text" class="fctl" id="so-dept" placeholder="แผนก IT / ขาย...">
                </div>
              </div>
              <div class="frow c1">
                <div class="fgrp">
                  <label class="flbl">หมายเหตุ</label>
                  <textarea class="fctl" id="so-note" rows="2"></textarea>
                </div>
              </div>
              <div style="display:flex;gap:8px;margin-top:4px">
                <button class="btn btn-w" onclick="doStockOut()">&#128228; บันทึกเบิกสินค้า</button>
                <button class="btn" onclick="clearStockOut()">&#10006; ล้างข้อมูล</button>
              </div>
            </div>
          </div>
          <div class="panel">
            <div class="ptitle">&#128202; ประวัติเบิกออกล่าสุด</div>
            <div class="pbody" style="padding:0">
              <table class="dt">
                <thead><tr><th>วันที่</th><th>รหัสสินค้า</th><th>ชื่อสินค้า</th><th class="tr">จำนวน</th><th>ผู้เบิก</th><th>แผนก</th><th>หมายเหตุ</th></tr></thead>
                <tbody id="so-history"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- ==================== STOCK HISTORY ==================== -->
      <div id="view-stock-history" class="view">
        <div class="phdr">
          <span class="phi">&#128202;</span>
          <h1>ประวัติการเคลื่อนไหวสต็อก</h1>
        </div>
        <div class="vbody" style="padding:0">
          <div class="abar">
            <select class="fctl" style="width:160px" id="hist-product-filter">
              <option value="">สินค้าทั้งหมด</option>
            </select>
            <select class="fctl" style="width:130px" id="hist-type-filter" onchange="renderHistory()">
              <option value="">ทุกประเภท</option>
              <option value="in">รับเข้า</option>
              <option value="out">เบิกออก</option>
            </select>
            <button class="btn btn-sm" onclick="renderHistory()">&#128269; ค้นหา</button>
          </div>
          <div class="twrap">
            <table class="dt">
              <thead><tr><th>วันที่-เวลา</th><th>รหัสสินค้า</th><th>ชื่อสินค้า</th><th class="tc">ประเภท</th><th class="tr">จำนวน</th><th class="tr">คงเหลือ</th><th>ผู้เกี่ยวข้อง</th><th>หมายเหตุ</th></tr></thead>
              <tbody id="history-tbody"></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ==================== INVOICE LIST ==================== -->
      <div id="view-invoice" class="view">
        <div class="phdr">
          <span class="phi">&#128220;</span>
          <h1>รายการใบ Invoice</h1>
          <div class="pha">
            <button class="btn btn-s btn-sm" onclick="navigate('invoice-create')">&#10133; สร้าง Invoice ใหม่</button>
          </div>
        </div>
        <div class="vbody" style="padding:0">
          <div class="abar">
            <button class="btn btn-s btn-sm" onclick="navigate('invoice-create')">&#10133; สร้าง Invoice ใหม่</button>
            <button class="btn btn-sm" onclick="renderInvoiceList()">&#8635; รีเฟรช</button>
            <div class="abar-right">
              <label style="font-size:11px">สถานะ:</label>
              <select class="fctl" style="width:120px" id="inv-filter-status" onchange="renderInvoiceList()">
                <option value="">ทั้งหมด</option>
                <option value="draft">ร่าง</option>
                <option value="sent">ส่งแล้ว</option>
                <option value="paid">ชำระแล้ว</option>
                <option value="overdue">เกินกำหนด</option>
              </select>
              <label style="font-size:11px">ค้นหา:</label>
              <input type="text" class="fctl" style="width:180px" id="inv-search" placeholder="เลขที่ / ชื่อลูกค้า..." oninput="renderInvoiceList()">
            </div>
          </div>
          <div class="twrap">
            <table class="dt" id="inv-table">
              <thead>
                <tr>
                  <th>เลขที่ Invoice</th>
                  <th>ลูกค้า</th>
                  <th>วันที่ออก</th>
                  <th>วันที่ครบกำหนด</th>
                  <th class="tr">ยอดรวม (฿)</th>
                  <th class="tc">สถานะ</th>
                  <th class="tc">จัดการ</th>
                </tr>
              </thead>
              <tbody id="inv-tbody"></tbody>
            </table>
          </div>
          <div class="abar" style="border-top:1px solid #B0ADA4;border-bottom:none">
            <span id="inv-count" style="font-size:10px;color:#555"></span>
            <span id="inv-total-sum" style="margin-left:auto;font-size:11px;font-weight:bold"></span>
          </div>
        </div>
      </div>

      <!-- ==================== INVOICE CREATE ==================== -->
      <div id="view-invoice-create" class="view">
        <div class="phdr">
          <span class="phi">&#10133;</span>
          <h1>สร้าง Invoice ใหม่</h1>
          <div class="pha">
            <button class="btn btn-s btn-sm" onclick="saveInvoice()">&#128190; บันทึก Invoice</button>
            <button class="btn btn-sm" onclick="navigate('invoice')">&#10006; ยกเลิก</button>
          </div>
        </div>
        <div class="vbody">

          <!-- Invoice Header Info -->
          <div class="panel mb12">
            <div class="ptitle">&#128203; ข้อมูลใบ Invoice</div>
            <div class="pbody">
              <div class="frow c3">
                <div class="fgrp">
                  <label class="flbl">เลขที่ Invoice *</label>
                  <input type="text" class="fctl" id="new-inv-no" placeholder="INV-2026-006">
                </div>
                <div class="fgrp">
                  <label class="flbl">วันที่ออก *</label>
                  <input type="date" class="fctl" id="new-inv-date">
                </div>
                <div class="fgrp">
                  <label class="flbl">วันที่ครบกำหนด *</label>
                  <input type="date" class="fctl" id="new-inv-due">
                </div>
              </div>
              <div class="frow c2">
                <div class="fgrp">
                  <label class="flbl">ชื่อลูกค้า / บริษัท *</label>
                  <input type="text" class="fctl" id="new-inv-customer" placeholder="ชื่อลูกค้าหรือบริษัท...">
                </div>
                <div class="fgrp">
                  <label class="flbl">ที่อยู่</label>
                  <input type="text" class="fctl" id="new-inv-addr" placeholder="ที่อยู่ลูกค้า...">
                </div>
              </div>
              <div class="frow c3">
                <div class="fgrp">
                  <label class="flbl">เบอร์โทร</label>
                  <input type="text" class="fctl" id="new-inv-tel" placeholder="0xx-xxx-xxxx">
                </div>
                <div class="fgrp">
                  <label class="flbl">อีเมล</label>
                  <input type="text" class="fctl" id="new-inv-email" placeholder="email@example.com">
                </div>
                <div class="fgrp">
                  <label class="flbl">ภาษีมูลค่าเพิ่ม (%)</label>
                  <select class="fctl" id="new-inv-vat" onchange="calcInvoice()">
                    <option value="7">7%</option>
                    <option value="0">0% (ไม่มี VAT)</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Invoice Items -->
          <div class="panel mb12">
            <div class="ptitle">
              &#128667; รายการสินค้า
              <button class="btn btn-s btn-sm" style="margin-left:auto" onclick="addInvoiceRow()">&#10133; เพิ่มรายการ</button>
            </div>
            <div class="pbody" style="padding:6px">
              <table class="inv-tbl">
                <thead>
                  <tr>
                    <th style="width:40px">#</th>
                    <th style="width:180px">สินค้า</th>
                    <th>รายละเอียด</th>
                    <th style="width:70px;text-align:right">จำนวน</th>
                    <th style="width:100px;text-align:right">ราคา/หน่วย (฿)</th>
                    <th style="width:110px;text-align:right">รวม (฿)</th>
                    <th style="width:36px"></th>
                  </tr>
                </thead>
                <tbody id="inv-row-body"></tbody>
              </table>
              <button class="btn btn-sm mt8" onclick="addInvoiceRow()">&#10133; เพิ่มรายการ</button>
            </div>
          </div>

          <!-- Totals + Note -->
          <div style="display:grid;grid-template-columns:1fr 240px;gap:12px">
            <div class="panel">
              <div class="ptitle">&#128203; หมายเหตุ / เงื่อนไขการชำระ</div>
              <div class="pbody">
                <textarea class="fctl" id="new-inv-note" rows="4" placeholder="เงื่อนไขการชำระเงิน, หมายเหตุ...">ชำระเงินภายใน 30 วัน</textarea>
              </div>
            </div>
            <div class="panel">
              <div class="ptitle">&#128182; สรุปยอด</div>
              <div class="pbody">
                <div class="trow"><span>ยอดรวมก่อนภาษี</span><span id="inv-sub" class="num">0.00</span></div>
                <div class="trow"><span id="inv-vat-lbl">ภาษีมูลค่าเพิ่ม 7%</span><span id="inv-vat-amt" class="num">0.00</span></div>
                <div class="trow" style="border-top:1px solid #ACA899;margin-top:4px;padding-top:4px">
                  <span>ส่วนลด</span>
                  <input type="number" class="fctl" id="inv-discount" style="width:80px;text-align:right" value="0" min="0" onchange="calcInvoice()">
                </div>
                <div class="trow grand"><span>&#9654; ยอดสุทธิ</span><span id="inv-total" class="num">0.00</span></div>
              </div>
            </div>
          </div>

          <div style="display:flex;gap:8px;margin-top:12px">
            <button class="btn btn-s" onclick="saveInvoice()">&#128190; บันทึก Invoice</button>
            <button class="btn btn-p" onclick="saveInvoice('sent')">&#128233; บันทึก &amp; ส่ง</button>
            <button class="btn" onclick="navigate('invoice')">&#10006; ยกเลิก</button>
          </div>

        </div>
      </div>

      <!-- ==================== INVOICE VIEW ==================== -->
      <div id="view-invoice-view" class="view">
        <div class="phdr">
          <span class="phi">&#128220;</span>
          <h1 id="iv-title">ดู Invoice</h1>
          <div class="pha">
            <button class="btn btn-sm" onclick="exportInvoicePDF()">&#128190; ดาวน์โหลด PDF</button>
            <button class="btn btn-sm" onclick="window.print()">&#128424; พิมพ์</button>
            <button class="btn btn-sm" onclick="navigate('invoice')">&#8592; กลับ</button>
          </div>
        </div>
        <div class="vbody">
          <div id="invoice-print-area"></div>
        </div>
      </div>

      <!-- ==================== REPORTS ==================== -->
      <div id="view-reports" class="view">
        <div class="phdr">
          <span class="phi">&#128202;</span>
          <h1>รายงานสรุป</h1>
          <div class="pha">
            <button class="btn btn-sm" onclick="renderReports()">&#8635; รีเฟรช</button>
          </div>
        </div>
        <div class="vbody">
          <div class="sgrid" id="report-cards"></div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
            <div class="panel">
              <div class="ptitle">&#128230; สินค้าคงเหลือน้อยสุด 8 รายการ</div>
              <div class="pbody" style="padding:0">
                <table class="dt" id="report-lowstock-table"></table>
              </div>
            </div>
            <div class="panel">
              <div class="ptitle">&#128220; Invoice ค้างชำระล่าสุด</div>
              <div class="pbody" style="padding:0">
                <table class="dt" id="report-unpaid-table"></table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ==================== SETTINGS ==================== -->
      <div id="view-settings" class="view">
        <div class="phdr">
          <span class="phi">&#9881;</span>
          <h1>ตั้งค่าระบบ</h1>
        </div>
        <div class="vbody">
          <div class="panel">
            <div class="ptitle">&#127968; ข้อมูลบริษัท / ร้านค้า</div>
            <div class="pbody">
              <div class="frow c2">
                <div class="fgrp"><label class="flbl">ชื่อบริษัท / ร้านค้า</label><input type="text" class="fctl" value="บริษัท วัชร สตีวีโดริ่ง จำกัด"></div>
                <div class="fgrp"><label class="flbl">เลขทะเบียนนิติบุคคล</label><input type="text" class="fctl" value="0105542084141"></div>
              </div>
              <div class="frow c1">
                <div class="fgrp"><label class="flbl">ที่อยู่</label><textarea class="fctl" rows="2">บริษัท วัชร สตีวีโดริ่ง จำกัด (สำนักงานใหญ่) พื้นที่ท่าเรือกรุงเทพ แขวงคลองเตย เขตคลองเตย กรุงเทพฯ</textarea></div>
              </div>
              <div class="frow c2">
                <div class="fgrp"><label class="flbl">เบอร์โทร</label><input type="text" class="fctl" value="02-xxx-xxxx"></div>
                <div class="fgrp"><label class="flbl">อีเมล</label><input type="text" class="fctl" value="sales@wachara-stevedoring.co.th"></div>
              </div>
              <button class="btn btn-p mt8">&#128190; บันทึกการตั้งค่า</button>
            </div>
          </div>
          <div class="panel">
            <div class="ptitle">&#128202; การตั้งค่า Invoice</div>
            <div class="pbody">
              <div class="frow c3">
                <div class="fgrp"><label class="flbl">รูปแบบเลขที่ Invoice</label><input type="text" class="fctl" value="INV-YYYY-###"></div>
                <div class="fgrp">
                  <label class="flbl">อัตราภาษี VAT (%)</label>
                  <select class="fctl"><option>7</option><option>0</option></select>
                </div>
                <div class="fgrp">
                  <label class="flbl">เงื่อนไขชำระเงิน (วัน)</label>
                  <input type="number" class="fctl" value="30">
                </div>
              </div>
              <button class="btn btn-p mt8">&#128190; บันทึก</button>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /main -->
  </div><!-- /layout -->

  <!-- STATUS BAR -->
  <div id="statusbar">
    <div class="sbp" id="sb-status">&#9679; พร้อมใช้งาน</div>
    <div class="sbp" id="sb-user">ผู้ใช้: -</div>
    <div class="sbp" id="sb-items"></div>
    <div class="sbp fx">
      <div class="mqw"><span class="mqi" id="sb-scroll"></span></div>
    </div>
    <div class="sbp" id="sb-datetime"></div>
  </div>

</div><!-- /app -->

<!-- ==================== MODAL: ADD/EDIT PRODUCT ==================== -->
<div class="mback" id="modal-product">
  <div class="mwin" style="max-width:580px">
    <div class="mtb">
      <span>&#128230;</span>
      <span class="mt" id="modal-product-title">เพิ่มสินค้าใหม่</span>
      <button class="wbtn wclose" onclick="closeModal('modal-product')">&#10005;</button>
    </div>
    <div class="mbody">
      <div class="frow c2">
        <div class="fgrp"><label class="flbl">รหัสสินค้า *</label><input type="text" class="fctl" id="p-code" placeholder="P001"></div>
        <div class="fgrp">
          <label class="flbl">หมวดหมู่ *</label>
          <select class="fctl" id="p-cat"></select>
        </div>
      </div>
      <div class="frow c1">
        <div class="fgrp"><label class="flbl">ชื่อสินค้า *</label><input type="text" class="fctl" id="p-name" placeholder="ชื่อสินค้า..."></div>
      </div>
      <div class="frow c2">
        <div class="fgrp"><label class="flbl">หน่วย</label><input type="text" class="fctl" id="p-unit" placeholder="ชิ้น / กล่อง / เครื่อง..."></div>
        <div class="fgrp">
          <label class="flbl">สถานะ</label>
          <select class="fctl" id="p-status">
            <option value="active">ใช้งาน (Active)</option>
            <option value="inactive">ไม่ใช้งาน (Inactive)</option>
          </select>
        </div>
      </div>
      <div class="frow c3">
        <div class="fgrp"><label class="flbl">สต็อกเริ่มต้น</label><input type="number" class="fctl" id="p-stock" value="0" min="0"></div>
        <div class="fgrp"><label class="flbl">สต็อกขั้นต่ำ (แจ้งเตือน)</label><input type="number" class="fctl" id="p-minstk" value="5" min="0"></div>
        <div class="fgrp"><label class="flbl">ตำแหน่งในคลัง</label><input type="text" class="fctl" id="p-location" placeholder="A-01 / ชั้น 2..."></div>
      </div>
      <div class="frow c2">
        <div class="fgrp"><label class="flbl">ราคาซื้อ (฿)</label><input type="number" class="fctl" id="p-buy" value="0" step="0.01" min="0"></div>
        <div class="fgrp"><label class="flbl">ราคาขาย (฿)</label><input type="number" class="fctl" id="p-sell" value="0" step="0.01" min="0"></div>
      </div>
      <div class="frow c1">
        <div class="fgrp"><label class="flbl">รายละเอียด</label><textarea class="fctl" id="p-desc" rows="2" placeholder="รายละเอียดสินค้า..."></textarea></div>
      </div>
    </div>
    <div class="mfoot">
      <button class="btn btn-s" onclick="saveProduct()">&#128190; บันทึก</button>
      <button class="btn" onclick="closeModal('modal-product')">&#10006; ยกเลิก</button>
    </div>
  </div>
</div>

<!-- ==================== MODAL: CONFIRM ==================== -->
<div class="mback" id="modal-confirm">
  <div class="mwin" style="min-width:340px;max-width:400px">
    <div class="mtb" style="background:linear-gradient(180deg,#AA1111 0%,#CC3333 50%,#AA1111 100%)">
      <span>&#9888;</span>
      <span class="mt">ยืนยันการลบ</span>
      <button class="wbtn wclose" onclick="closeModal('modal-confirm')">&#10005;</button>
    </div>
    <div class="mbody" style="text-align:center;padding:20px">
      <div style="font-size:36px;margin-bottom:10px">&#128465;</div>
      <div id="confirm-msg" style="font-size:13px;margin-bottom:6px"></div>
      <div style="font-size:11px;color:#666">การกระทำนี้ไม่สามารถย้อนกลับได้</div>
    </div>
    <div class="mfoot">
      <button class="btn btn-d" id="confirm-ok-btn">&#128465; ลบ</button>
      <button class="btn" onclick="closeModal('modal-confirm')">&#10006; ยกเลิก</button>
    </div>
  </div>
</div>

<!-- ==================== MODAL: STOCK ADJUST ==================== -->
<div class="mback" id="modal-adjust">
  <div class="mwin" style="max-width:420px">
    <div class="mtb">
      <span id="adj-icon">&#128229;</span>
      <span class="mt" id="adj-title">ปรับสต็อก</span>
      <button class="wbtn wclose" onclick="closeModal('modal-adjust')">&#10005;</button>
    </div>
    <div class="mbody">
      <div class="frow c1 mb8">
        <div class="fgrp">
          <label class="flbl">สินค้า</label>
          <input type="text" class="fctl" id="adj-product-name" readonly style="background:#F0F0F0">
        </div>
      </div>
      <div class="frow c2">
        <div class="fgrp"><label class="flbl">สต็อกปัจจุบัน</label><input type="text" class="fctl" id="adj-current" readonly style="background:#F0F0F0;font-weight:bold"></div>
        <div class="fgrp"><label class="flbl">จำนวน *</label><input type="number" class="fctl" id="adj-qty" min="1" value="1"></div>
      </div>
      <div class="frow c1">
        <div class="fgrp"><label class="flbl">หมายเหตุ</label><input type="text" class="fctl" id="adj-note" placeholder="หมายเหตุ..."></div>
      </div>
    </div>
    <div class="mfoot">
      <button class="btn btn-p" id="adj-confirm-btn">&#9989; ยืนยัน</button>
      <button class="btn" onclick="closeModal('modal-adjust')">&#10006; ยกเลิก</button>
    </div>
  </div>
</div>

<!-- ==================== MODAL: FILE MENU ==================== -->
<div class="mback" id="modal-file">
  <div class="mwin" style="max-width:420px">
    <div class="mtb">
      <span>&#128193;</span>
      <span class="mt">ไฟล์ (F)</span>
      <button class="wbtn wclose" onclick="closeModal('modal-file')">&#10005;</button>
    </div>
    <div class="mbody">
      <div style="display:grid;gap:8px">
        <button class="btn" onclick="navigate('invoice-create');closeModal('modal-file')">&#10133; สร้าง Invoice ใหม่</button>
        <button class="btn" onclick="navigate('stock');openAddProduct();closeModal('modal-file')">&#128230; เพิ่มสินค้าใหม่</button>
        <button class="btn" onclick="printPage();closeModal('modal-file')">&#128424; พิมพ์หน้าปัจจุบัน</button>
      </div>
    </div>
    <div class="mfoot">
      <button class="btn" onclick="closeModal('modal-file')">ปิด</button>
    </div>
  </div>
</div>

<!-- ==================== MODAL: HELP ==================== -->
<div class="mback" id="modal-help">
  <div class="mwin" style="max-width:520px">
    <div class="mtb">
      <span>&#10067;</span>
      <span class="mt">ช่วยเหลือ (H)</span>
      <button class="wbtn wclose" onclick="closeModal('modal-help')">&#10005;</button>
    </div>
    <div class="mbody">
      <div style="font-size:12px;font-weight:bold;color:#002D86;margin-bottom:8px">คู่มือใช้งานย่อ</div>
      <div style="font-size:11px;line-height:1.7">
        1) ไปที่เมนู <b>สต็อก</b> เพื่อเพิ่มสินค้า, รับเข้า, เบิกออก<br>
        2) ไปที่เมนู <b>Invoice</b> เพื่อสร้างและติดตามสถานะใบแจ้งหนี้<br>
        3) ไปที่เมนู <b>รายงาน</b> เพื่อดูยอดคงเหลือและรายการค้างชำระ<br>
        4) เมนู <b>ตั้งค่า</b> ใช้ปรับข้อมูลบริษัทและรูปแบบเอกสาร
      </div>
      <div class="hint-box" style="margin-top:10px">
        ติดต่อ support (ตัวอย่าง): support@wachara-stevedoring.co.th
      </div>
    </div>
    <div class="mfoot">
      <button class="btn" onclick="closeModal('modal-help')">ปิด</button>
    </div>
  </div>
</div>

<!-- ==================== MODAL: INVOICE VIEW DETAIL ==================== -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
/* =====================================================
   STOCKMASTER PRO 2000 - DATA & LOGIC
   ===================================================== */

// ======== MOCK DATA ========
let CATEGORIES = [];
let products = [];
let invoices = [];
let stockMovements = [];

// Current state
let currentView = 'dashboard';
let editingProductId = null;
let currentInvoiceRows = [];
let pendingDeleteId = null;
let pendingAdjustType = null;
let pendingAdjustPid = null;
let currentUser = null;

const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

async function apiFetch(url, options = {}) {
  const res = await fetch(url, {
    credentials: 'same-origin',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': CSRF_TOKEN,
      ...(options.headers || {}),
    },
    ...options,
  });

  let body = null;
  try { body = await res.json(); } catch (_e) {}

  if (!res.ok) {
    const msg = body && body.message ? body.message : 'เกิดข้อผิดพลาดจากเซิร์ฟเวอร์';
    throw new Error(msg);
  }

  return body || {};
}

async function loadBootstrapData() {
  const data = await apiFetch('/api/bootstrap', { method: 'GET' });
  CATEGORIES = data.categories || [];
  products = data.products || [];
  invoices = data.invoices || [];
  stockMovements = data.stockMovements || [];
  currentUser = data.user || null;
}

// ======== NAVIGATION ========
function navigate(view) {
  document.querySelectorAll('.view').forEach(v=>v.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
  document.querySelectorAll('.tbtn').forEach(b=>b.classList.remove('tactive'));

  const el = document.getElementById('view-'+view);
  if(!el){ showStatus('&#9888; ไม่พบหน้านี้'); return; }
  el.classList.add('active');
  currentView = view;

  // Sidebar highlight
  document.querySelectorAll('.nav-item').forEach(n=>{
    if(n.getAttribute('onclick')&&n.getAttribute('onclick').includes("'"+view+"'")){
      n.classList.add('active');
    }
  });

  // Render appropriate view
  const renders = {
    'dashboard': renderDashboard,
    'stock': renderStock,
    'stock-in': renderStockIn,
    'stock-out': renderStockOut,
    'stock-history': renderHistory,
    'invoice': renderInvoiceList,
    'invoice-create': renderInvoiceCreate,
    'reports': renderReports,
  };
  if(renders[view]) renders[view]();
  updateStatusBar();
}

// ======== STATUS BAR ========
function updateStatusBar(){
  const statusMap={
    'dashboard':'ภาพรวมระบบ',
    'stock':'รายการสินค้า',
    'stock-in':'รับสินค้าเข้าสต็อก',
    'stock-out':'เบิกสินค้าออก',
    'stock-history':'ประวัติการเคลื่อนไหว',
    'invoice':'รายการ Invoice',
    'invoice-create':'สร้าง Invoice ใหม่',
    'invoice-view':'ดู Invoice',
    'reports':'รายงานสรุป',
    'settings':'ตั้งค่าระบบ',
  };
  document.getElementById('sb-status').innerHTML='&#9679; '+( statusMap[currentView]||'พร้อมใช้งาน');
  document.getElementById('sb-user').textContent='ผู้ใช้: '+(currentUser ? currentUser.name : '-');
  document.getElementById('sb-items').textContent='สินค้า: '+products.length+' รายการ | Invoice: '+invoices.length+' ใบ';
}

function showLogin(){
  const app=document.getElementById('app');
  const login=document.getElementById('login-screen');
  if(app) app.style.display='none';
  if(login) login.style.display='flex';
}

function hideLogin(){
  const app=document.getElementById('app');
  const login=document.getElementById('login-screen');
  if(app) app.style.display='flex';
  if(login) login.style.display='none';
}

async function loginSubmit(e){
  e.preventDefault();
  const username=(document.getElementById('login-username')||{}).value||'';
  const password=(document.getElementById('login-password')||{}).value||'';
  const err=document.getElementById('login-error');

  try {
    await apiFetch('/auth/login', {
      method: 'POST',
      body: JSON.stringify({ username: username.trim(), password }),
    });

    await loadBootstrapData();
    hideLogin();
    renderDashboard();
    updateStatusBar();
    showStatus('&#9989; เข้าสู่ระบบสำเร็จ: '+(currentUser ? currentUser.name : 'ผู้ใช้งาน'));

    if(err){
      err.style.display='none';
      err.textContent='';
    }
  } catch (error) {
    if(err){
      err.style.display='block';
      err.textContent=error.message || 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
    }
  }
}

async function logout(){
  try {
    await apiFetch('/auth/logout', { method: 'POST' });
  } catch (_error) {}

  currentUser = null;
  products = [];
  invoices = [];
  stockMovements = [];
  CATEGORIES = [];

  showLogin();
  const form=document.getElementById('login-form');
  if(form) form.reset();
  const err=document.getElementById('login-error');
  if(err){
    err.style.display='none';
    err.textContent='';
  }
  updateStatusBar();
}

function updateClock(){
  const now=new Date();
  const d=now.toLocaleDateString('th-TH',{year:'numeric',month:'short',day:'numeric'});
  const t=now.toLocaleTimeString('th-TH',{hour:'2-digit',minute:'2-digit',second:'2-digit'});
  const el=document.getElementById('sb-datetime');
  if(el) el.textContent=d+' '+t;
  const dash=document.getElementById('dash-time');
  if(dash) dash.textContent=d+' '+t;
}

setInterval(updateClock,1000);
updateClock();

function showStatus(msg){
  document.getElementById('sb-status').innerHTML=msg;
  setTimeout(()=>updateStatusBar(),3000);
}

function openFileMenu(){ openModal('modal-file'); }
function openHelp(){ openModal('modal-help'); }

function renderReports(){
  const totalProducts = products.length;
  const lowCount = products.filter(p=>p.stock<=p.minStock&&p.stock>0).length;
  const outCount = products.filter(p=>p.stock===0).length;
  const invoiceTotal = invoices.reduce((s,i)=>s+i.total,0);
  const paidTotal = invoices.filter(i=>i.status==='paid').reduce((s,i)=>s+i.total,0);

  document.getElementById('report-cards').innerHTML = `
    <div class="scard cb"><div class="sc-h">&#128230; สินค้าทั้งหมด</div><div class="sc-b"><div><div class="sc-v">${totalProducts}</div><div class="sc-sub">รายการ</div></div><div class="sc-ico">&#128230;</div></div></div>
    <div class="scard co"><div class="sc-h">&#9888; ใกล้หมด/หมด</div><div class="sc-b"><div><div class="sc-v">${lowCount+outCount}</div><div class="sc-sub">ต้องติดตาม</div></div><div class="sc-ico">&#9888;</div></div></div>
    <div class="scard cr"><div class="sc-h">&#128220; ยอดขายรวมทั้งหมด</div><div class="sc-b"><div><div class="sc-v" style="font-size:18px">${fmt(invoiceTotal)}</div><div class="sc-sub">บาท</div></div><div class="sc-ico">&#128220;</div></div></div>
    <div class="scard cg"><div class="sc-h">&#128176; ยอดรับชำระแล้ว</div><div class="sc-b"><div><div class="sc-v" style="font-size:18px">${fmt(paidTotal)}</div><div class="sc-sub">บาท</div></div><div class="sc-ico">&#128176;</div></div></div>
  `;

  const lowRows = products
    .slice()
    .sort((a,b)=>a.stock-b.stock)
    .slice(0,8);

  document.getElementById('report-lowstock-table').innerHTML = `
    <thead><tr><th>รหัส</th><th>สินค้า</th><th class="tr">คงเหลือ</th><th class="tr">ขั้นต่ำ</th></tr></thead>
    <tbody>${lowRows.map(p=>`<tr><td>${p.code}</td><td>${p.name}</td><td class="tr num ${p.stock===0?'row-out':p.stock<=p.minStock?'row-low':'row-ok'}">${p.stock}</td><td class="tr num">${p.minStock}</td></tr>`).join('')}</tbody>
  `;

  const unpaidRows = invoices
    .filter(i=>i.status==='sent'||i.status==='overdue')
    .slice()
    .reverse()
    .slice(0,8);

  document.getElementById('report-unpaid-table').innerHTML = `
    <thead><tr><th>เลขที่</th><th>ลูกค้า</th><th class="tr">ยอด (฿)</th><th class="tc">สถานะ</th></tr></thead>
    <tbody>${unpaidRows.length?unpaidRows.map(i=>`<tr><td>${i.no}</td><td>${i.customer}</td><td class="tr num">${fmt(i.total)}</td><td class="tc">${invBadge(i.status)}</td></tr>`).join(''):'<tr><td colspan="4" class="tc" style="padding:12px;color:#666">ไม่มีรายการค้างชำระ</td></tr>'}</tbody>
  `;
}

// ======== DASHBOARD ========
function renderDashboard(){
  const totalProducts=products.length;
  const lowStock=products.filter(p=>p.stock>0&&p.stock<=p.minStock).length;
  const outStock=products.filter(p=>p.stock===0).length;
  const unpaidInv=invoices.filter(i=>i.status==='sent'||i.status==='overdue').length;
  const totalRevenue=invoices.filter(i=>i.status==='paid').reduce((s,i)=>s+i.total,0);

  document.getElementById('stat-cards').innerHTML=`
    <div class="scard cb">
      <div class="sc-h">&#128230; สินค้าทั้งหมด</div>
      <div class="sc-b"><div><div class="sc-v">${totalProducts}</div><div class="sc-sub">รายการสินค้า</div></div><div class="sc-ico">&#128230;</div></div>
    </div>
    <div class="scard co">
      <div class="sc-h">&#9888; สต็อกต่ำ / หมด</div>
      <div class="sc-b"><div><div class="sc-v">${lowStock+outStock}</div><div class="sc-sub">ต้องสั่งซื้อเพิ่ม</div></div><div class="sc-ico">&#9888;</div></div>
    </div>
    <div class="scard cr">
      <div class="sc-h">&#128220; Invoice ค้างชำระ</div>
      <div class="sc-b"><div><div class="sc-v">${unpaidInv}</div><div class="sc-sub">รอการชำระเงิน</div></div><div class="sc-ico">&#128220;</div></div>
    </div>
    <div class="scard cg">
      <div class="sc-h">&#128176; รายได้ที่ได้รับ</div>
      <div class="sc-b"><div><div class="sc-v" style="font-size:18px">${fmt(totalRevenue)}</div><div class="sc-sub">จาก Invoice ที่ชำระแล้ว</div></div><div class="sc-ico">&#128176;</div></div>
    </div>
  `;

  // Recent stock
  const rStock=products.slice().sort(()=>Math.random()-.5).slice(0,5);
  document.getElementById('dash-recent-stock').innerHTML=`
    <thead><tr><th>รหัส</th><th>ชื่อสินค้า</th><th class="tr">สต็อก</th><th class="tc">สถานะ</th></tr></thead>
    <tbody>${rStock.map(p=>`<tr><td>${p.code}</td><td>${p.name}</td><td class="tr num ${p.stock===0?'row-out':p.stock<=p.minStock?'row-low':'row-ok'}">${p.stock}</td><td class="tc">${stockBadge(p)}</td></tr>`).join('')}</tbody>
  `;

  // Low stock
  const lowProds=products.filter(p=>p.stock<=p.minStock).slice(0,6);
  document.getElementById('dash-lowstock').innerHTML=`
    <thead><tr><th>ชื่อสินค้า</th><th class="tr">คงเหลือ</th><th class="tr">ขั้นต่ำ</th></tr></thead>
    <tbody>${lowProds.length?lowProds.map(p=>`<tr><td>${p.name}</td><td class="tr num ${p.stock===0?'row-out':'row-low'}">${p.stock}</td><td class="tr num">${p.minStock}</td></tr>`).join(''):'<tr><td colspan="3" class="tc" style="padding:12px;color:#666">&#9989; ไม่มีสินค้าใกล้หมด</td></tr>'}</tbody>
  `;

  // Recent invoices
  const rInv=invoices.slice().reverse().slice(0,5);
  document.getElementById('dash-invoices').innerHTML=`
    <thead><tr><th>เลขที่</th><th>ลูกค้า</th><th class="tr">ยอดรวม (฿)</th><th class="tc">สถานะ</th><th class="tc">จัดการ</th></tr></thead>
    <tbody>${rInv.map(i=>`<tr><td>${i.no}</td><td>${i.customer}</td><td class="tr num">${fmt(i.total)}</td><td class="tc">${invBadge(i.status)}</td><td class="tc"><button class="btn btn-sm" onclick="viewInvoice('${i.id}')">&#128065; ดู</button></td></tr>`).join('')}</tbody>
  `;
}

// ======== STOCK ========
function renderStock(){
  // Populate category filter
  const catSel=document.getElementById('filter-cat');
  if(catSel && catSel.options.length<=1){
    CATEGORIES.forEach(c=>{ const o=document.createElement('option'); o.value=c; o.textContent=c; catSel.appendChild(o); });
  }

  const search=(document.getElementById('stock-search')||{}).value||'';
  const cat=(document.getElementById('filter-cat')||{}).value||'';
  let filtered=products.filter(p=>{
    const matchCat=!cat||p.cat===cat;
    const matchSearch=!search||p.name.toLowerCase().includes(search.toLowerCase())||p.code.toLowerCase().includes(search.toLowerCase());
    return matchCat&&matchSearch;
  });

  document.getElementById('stock-tbody').innerHTML=filtered.map(p=>`
    <tr>
      <td><tt>${p.code}</tt></td>
      <td>${p.name}</td>
      <td>${p.cat}</td>
      <td>${p.unit}</td>
      <td class="tr num ${p.stock===0?'row-out':p.stock<=p.minStock?'row-low':'row-ok'}">${p.stock}</td>
      <td class="tr num">${p.minStock}</td>
      <td class="tr num">${fmt(p.buyPrice)}</td>
      <td class="tr num">${fmt(p.sellPrice)}</td>
      <td class="tc">${stockBadge(p)}</td>
      <td class="tc" style="white-space:nowrap;padding:3px 5px">
        <button class="btn btn-sm" onclick="openStockIn('${p.id}')" title="รับเข้า">&#128229;</button>
        <button class="btn btn-sm" onclick="openStockOut('${p.id}')" title="เบิกออก">&#128228;</button>
        <button class="btn btn-sm btn-p" onclick="openEditProduct('${p.id}')" title="แก้ไข">&#9999;</button>
        <button class="btn btn-sm btn-d" onclick="confirmDelete('${p.id}')" title="ลบ">&#128465;</button>
      </td>
    </tr>
  `).join('');
  document.getElementById('stock-count').textContent='แสดง '+filtered.length+' จาก '+products.length+' รายการ';
}

// ======== PRODUCT CRUD ========
function openAddProduct(){
  editingProductId=null;
  document.getElementById('modal-product-title').textContent='เพิ่มสินค้าใหม่';
  clearForm(['p-code','p-name','p-unit','p-desc','p-location']);
  document.getElementById('p-stock').value=0;
  document.getElementById('p-minstk').value=5;
  document.getElementById('p-buy').value=0;
  document.getElementById('p-sell').value=0;
  document.getElementById('p-status').value='active';
  populateCatSelect();
  openModal('modal-product');
  navigate('stock');
}

function openEditProduct(id){
  const p=products.find(x=>String(x.id)===String(id));
  if(!p) return;
  editingProductId=id;
  document.getElementById('modal-product-title').textContent='แก้ไขสินค้า — '+p.code;
  document.getElementById('p-code').value=p.code;
  document.getElementById('p-name').value=p.name;
  document.getElementById('p-unit').value=p.unit;
  document.getElementById('p-stock').value=p.stock;
  document.getElementById('p-minstk').value=p.minStock;
  document.getElementById('p-buy').value=p.buyPrice;
  document.getElementById('p-sell').value=p.sellPrice;
  document.getElementById('p-status').value=p.status;
  document.getElementById('p-desc').value=p.desc||'';
  document.getElementById('p-location').value=p.location||'';
  populateCatSelect(p.cat);
  openModal('modal-product');
}

function populateCatSelect(selected=''){
  const sel=document.getElementById('p-cat');
  sel.innerHTML=CATEGORIES.map(c=>`<option value="${c}"${c===selected?' selected':''}>${c}</option>`).join('');
}

async function saveProduct(){
  const code=v('p-code'),name=v('p-name');
  if(!code||!name){ alert('กรุณากรอกรหัสและชื่อสินค้า'); return; }
  const data={
    code,name,
    cat:v('p-cat'),unit:v('p-unit'),
    stock:parseInt(v('p-stock'))||0,
    minStock:parseInt(v('p-minstk'))||5,
    buyPrice:parseFloat(v('p-buy'))||0,
    sellPrice:parseFloat(v('p-sell'))||0,
    status:v('p-status'),
    desc:v('p-desc'),location:v('p-location'),
  };

  try {
    if(editingProductId){
      await apiFetch('/api/products/'+editingProductId, {
        method:'PUT',
        body: JSON.stringify(data),
      });
      showStatus('&#9989; แก้ไขสินค้าเรียบร้อยแล้ว');
    } else {
      await apiFetch('/api/products', {
        method:'POST',
        body: JSON.stringify(data),
      });
      showStatus('&#9989; เพิ่มสินค้าใหม่เรียบร้อยแล้ว');
    }
    await loadBootstrapData();
  } catch (error) {
    alert(error.message || 'บันทึกสินค้าไม่สำเร็จ');
    return;
  }

  closeModal('modal-product');
  renderStock();
  renderDashboard();
}

function confirmDelete(id){
  const p=products.find(x=>String(x.id)===String(id));
  if(!p) return;
  document.getElementById('confirm-msg').textContent='คุณต้องการลบสินค้า "'+p.name+'" ใช่หรือไม่?';
  pendingDeleteId=id;
  document.getElementById('confirm-ok-btn').onclick=async function(){
    try {
      await apiFetch('/api/products/'+id, { method:'DELETE' });
      await loadBootstrapData();
      closeModal('modal-confirm');
      renderStock();
      renderDashboard();
      showStatus('&#9989; ลบสินค้าเรียบร้อยแล้ว');
    } catch (error) {
      alert(error.message || 'ลบสินค้าไม่สำเร็จ');
    }
  };
  openModal('modal-confirm');
}

// ======== STOCK ADJUST ========
function openStockIn(pid){
  const p=products.find(x=>String(x.id)===String(pid));
  if(!p) return;
  pendingAdjustType='in';
  pendingAdjustPid=pid;
  document.getElementById('adj-icon').textContent='📥';
  document.getElementById('adj-title').textContent='รับสินค้าเข้า — '+p.name;
  document.getElementById('adj-product-name').value=p.name;
  document.getElementById('adj-current').value=p.stock+' '+p.unit;
  document.getElementById('adj-qty').value=1;
  document.getElementById('adj-note').value='';
  document.getElementById('adj-confirm-btn').textContent='📥 รับเข้าสต็อก';
  document.getElementById('adj-confirm-btn').className='btn btn-s';
  document.getElementById('adj-confirm-btn').onclick=doAdjust;
  openModal('modal-adjust');
}

function openStockOut(pid){
  const p=products.find(x=>String(x.id)===String(pid));
  if(!p) return;
  pendingAdjustType='out';
  pendingAdjustPid=pid;
  document.getElementById('adj-icon').textContent='📤';
  document.getElementById('adj-title').textContent='เบิกสินค้าออก — '+p.name;
  document.getElementById('adj-product-name').value=p.name;
  document.getElementById('adj-current').value=p.stock+' '+p.unit;
  document.getElementById('adj-qty').value=1;
  document.getElementById('adj-note').value='';
  document.getElementById('adj-confirm-btn').textContent='📤 เบิกออกสต็อก';
  document.getElementById('adj-confirm-btn').className='btn btn-w';
  document.getElementById('adj-confirm-btn').onclick=doAdjust;
  openModal('modal-adjust');
}

async function doAdjust(){
  const p=products.find(x=>String(x.id)===String(pendingAdjustPid));
  if(!p) return;
  const qty=parseInt(document.getElementById('adj-qty').value)||0;
  if(qty<=0){ alert('กรุณาระบุจำนวนที่ถูกต้อง'); return; }
  if(pendingAdjustType==='out'&&qty>p.stock){ alert('สต็อกไม่เพียงพอ! คงเหลือ: '+p.stock+' '+p.unit); return; }

  try {
    if(pendingAdjustType==='in'){
      await apiFetch('/api/stock/in', {
        method:'POST',
        body: JSON.stringify({
          product_id: parseInt(p.id),
          quantity: qty,
          note: document.getElementById('adj-note').value || '',
        }),
      });
    } else {
      await apiFetch('/api/stock/out', {
        method:'POST',
        body: JSON.stringify({
          product_id: parseInt(p.id),
          quantity: qty,
          note: document.getElementById('adj-note').value || '',
        }),
      });
    }

    await loadBootstrapData();
  } catch (error) {
    alert(error.message || 'บันทึกสต็อกไม่สำเร็จ');
    return;
  }

  closeModal('modal-adjust');
  renderStock();
  renderDashboard();
  showStatus(`&#9989; ${pendingAdjustType==='in'?'รับเข้า':'เบิกออก'} ${qty} ${p.unit} เรียบร้อยแล้ว`);
}

// ======== STOCK IN/OUT FORMS ========
function renderStockIn(){
  const sel=document.getElementById('si-product');
  sel.innerHTML=products.map(p=>`<option value="${p.id}">${p.code} — ${p.name} (คงเหลือ: ${p.stock} ${p.unit})</option>`).join('');
  document.getElementById('si-date').valueAsDate=new Date();
  renderSIHistory();
}

function renderSIHistory(){
  const rows=stockMovements.filter(m=>m.type==='in').slice(0,8);
  document.getElementById('si-history').innerHTML=rows.map(m=>`
    <tr><td>${m.date}</td><td>${m.pid}</td><td>${m.pname}</td>
    <td class="tr num row-ok">+${m.qty}</td><td class="tr">—</td><td>${m.user}</td><td>${m.note}</td></tr>
  `).join('')||'<tr><td colspan="7" class="tc" style="padding:10px;color:#888">ยังไม่มีประวัติ</td></tr>';
}

async function doStockIn(){
  const pid=v('si-product');const p=products.find(x=>String(x.id)===String(pid));
  if(!p) return;
  const qty=parseInt(v('si-qty'))||0;
  if(qty<=0){alert('ระบุจำนวนที่ถูกต้อง');return;}

  try {
    await apiFetch('/api/stock/in', {
      method:'POST',
      body: JSON.stringify({
        product_id: parseInt(p.id),
        quantity: qty,
        unit_price: parseFloat(v('si-price')) || 0,
        supplier: v('si-supplier') || '',
        note: v('si-note') || '',
      }),
    });
    await loadBootstrapData();
  } catch (error) {
    alert(error.message || 'รับสินค้าไม่สำเร็จ');
    return;
  }

  showStatus(`&#9989; รับเข้า ${qty} ${p.unit} (${p.name}) เรียบร้อย`);
  clearStockIn();
  renderSIHistory();
  renderDashboard();
}

function clearStockIn(){
  ['si-qty','si-supplier','si-note'].forEach(id=>{ const e=document.getElementById(id); if(e) e.value= id==='si-qty'?'1':''; });
}

function renderStockOut(){
  const sel=document.getElementById('so-product');
  sel.innerHTML=products.map(p=>`<option value="${p.id}">${p.code} — ${p.name} (คงเหลือ: ${p.stock} ${p.unit})</option>`).join('');
  document.getElementById('so-date').valueAsDate=new Date();
  renderSOHistory();
}

function renderSOHistory(){
  const rows=stockMovements.filter(m=>m.type==='out').slice(0,8);
  document.getElementById('so-history').innerHTML=rows.map(m=>`
    <tr><td>${m.date}</td><td>${m.pid}</td><td>${m.pname}</td>
    <td class="tr num row-out">-${m.qty}</td><td>${m.user}</td><td>—</td><td>${m.note}</td></tr>
  `).join('')||'<tr><td colspan="7" class="tc" style="padding:10px;color:#888">ยังไม่มีประวัติ</td></tr>';
}

async function doStockOut(){
  const pid=v('so-product');const p=products.find(x=>String(x.id)===String(pid));
  if(!p) return;
  const qty=parseInt(v('so-qty'))||0;
  if(qty<=0){alert('ระบุจำนวนที่ถูกต้อง');return;}
  if(qty>p.stock){alert('สต็อกไม่เพียงพอ! คงเหลือ: '+p.stock+' '+p.unit);return;}

  try {
    await apiFetch('/api/stock/out', {
      method:'POST',
      body: JSON.stringify({
        product_id: parseInt(p.id),
        quantity: qty,
        requester: v('so-requester') || '',
        department: v('so-dept') || '',
        note: v('so-note') || '',
      }),
    });
    await loadBootstrapData();
  } catch (error) {
    alert(error.message || 'เบิกสินค้าไม่สำเร็จ');
    return;
  }

  showStatus(`&#9989; เบิกออก ${qty} ${p.unit} (${p.name}) เรียบร้อย`);
  clearStockOut();
  renderSOHistory();
  renderDashboard();
}

function clearStockOut(){
  ['so-qty','so-requester','so-dept','so-note'].forEach(id=>{ const e=document.getElementById(id); if(e) e.value= id==='so-qty'?'1':''; });
}

// ======== STOCK HISTORY ========
function renderHistory(){
  const pFilter=(document.getElementById('hist-product-filter')||{}).value||'';
  const tFilter=(document.getElementById('hist-type-filter')||{}).value||'';
  const sel=document.getElementById('hist-product-filter');
  if(sel&&sel.options.length<=1){
    products.forEach(p=>{ const o=document.createElement('option'); o.value=p.id; o.textContent=p.code+' — '+p.name; sel.appendChild(o); });
  }
  let rows=stockMovements;
  if(pFilter) rows=rows.filter(m=>String(m.pid)===String(pFilter));
  if(tFilter) rows=rows.filter(m=>m.type===tFilter);
  document.getElementById('history-tbody').innerHTML=rows.map(m=>`
    <tr>
      <td>${m.date}</td><td><tt>${m.pid}</tt></td><td>${m.pname}</td>
      <td class="tc">${m.type==='in'?'<span class="badge bog">&#128229; รับเข้า</span>':'<span class="badge bow">&#128228; เบิกออก</span>'}</td>
      <td class="tr num ${m.type==='in'?'row-ok':'row-out'}">${m.type==='in'?'+':'-'}${m.qty}</td>
      <td class="tr num">${m.balance}</td>
      <td>${m.user}</td><td>${m.note}</td>
    </tr>
  `).join('')||'<tr><td colspan="8" class="tc" style="padding:12px;color:#888">ไม่พบข้อมูล</td></tr>';
}

// ======== INVOICE LIST ========
function renderInvoiceList(){
  const search=(document.getElementById('inv-search')||{}).value||'';
  const status=(document.getElementById('inv-filter-status')||{}).value||'';
  let filtered=invoices.filter(i=>{
    const ms=!status||i.status===status;
    const mq=!search||i.no.toLowerCase().includes(search.toLowerCase())||i.customer.toLowerCase().includes(search.toLowerCase());
    return ms&&mq;
  });
  document.getElementById('inv-tbody').innerHTML=filtered.map(i=>`
    <tr>
      <td><b>${i.no}</b></td>
      <td>${i.customer}</td>
      <td>${fmtDate(i.date)}</td>
      <td>${fmtDate(i.due)}</td>
      <td class="tr num"><b>${fmt(i.total)}</b></td>
      <td class="tc">${invBadge(i.status)}</td>
      <td class="tc" style="white-space:nowrap;padding:3px 5px">
        <button class="btn btn-sm" onclick="viewInvoice('${i.id}')">&#128065; ดู</button>
        ${i.status==='draft'?`<button class="btn btn-sm btn-p" onclick="markInvoice('${i.id}','sent')">&#128233; ส่ง</button>`:''}
        ${i.status==='sent'?`<button class="btn btn-sm btn-s" onclick="markInvoice('${i.id}','paid')">&#9989; ชำระแล้ว</button>`:''}
        <button class="btn btn-sm btn-d" onclick="deleteInvoice('${i.id}')">&#128465;</button>
      </td>
    </tr>
  `).join('')||'<tr><td colspan="7" class="tc" style="padding:12px;color:#888">ไม่พบข้อมูล</td></tr>';
  const total=filtered.reduce((s,i)=>s+i.total,0);
  document.getElementById('inv-count').textContent='แสดง '+filtered.length+' จาก '+invoices.length+' ใบ';
  document.getElementById('inv-total-sum').textContent='ยอดรวม: ฿'+fmt(total);
}

async function markInvoice(id,status){
  try {
    await apiFetch('/api/invoices/'+id+'/status', {
      method: 'PATCH',
      body: JSON.stringify({ status }),
    });
    await loadBootstrapData();
    renderInvoiceList();
    showStatus('&#9989; อัปเดตสถานะ Invoice เรียบร้อย');
  } catch (error) {
    alert(error.message || 'อัปเดตสถานะไม่สำเร็จ');
  }
}

function deleteInvoice(id){
  const inv=invoices.find(i=>String(i.id)===String(id));
  if(!inv) return;
  document.getElementById('confirm-msg').textContent='ต้องการลบ Invoice "'+inv.no+'" ใช่หรือไม่?';
  document.getElementById('confirm-ok-btn').onclick=async function(){
    try {
      await apiFetch('/api/invoices/'+id, { method: 'DELETE' });
      await loadBootstrapData();
      closeModal('modal-confirm');
      renderInvoiceList();
      showStatus('&#9989; ลบ Invoice เรียบร้อยแล้ว');
    } catch (error) {
      alert(error.message || 'ลบ Invoice ไม่สำเร็จ');
    }
  };
  openModal('modal-confirm');
}

function viewInvoice(id){
  const inv=invoices.find(i=>String(i.id)===String(id));
  if(!inv) return;
  document.getElementById('iv-title').textContent='Invoice — '+inv.no;
  const statusColors={'paid':'#006600','sent':'#003399','draft':'#555','overdue':'#CC0000'};
  const statusTH={'paid':'ชำระแล้ว','sent':'ส่งแล้ว','draft':'ร่าง','overdue':'เกินกำหนด'};
  document.getElementById('invoice-print-area').innerHTML=`
    <div class="ivp">
      <div class="ivp-hdr">
        <div>
          <div class="c-logo">&#128230; Stock Master Pro 2000&#8482;</div>
          <div style="font-size:11px;margin-top:4px;color:#333">บริษัท วัชร สตีวีโดริ่ง จำกัด (WACHARA STEVEDORING COMPANY LIMITED)<br>เลขทะเบียน: 0105542084141<br>ธุรกิจ: รับขนถ่ายสินค้าในท่าเรือ และจำหน่ายอุปกรณ์ไฟฟ้าเพื่อให้แสงสว่าง</div>
        </div>
        <div class="inv-no-box">
          <div style="font-size:11px;color:#666">เลขที่ใบ Invoice</div>
          <div style="font-size:20px;font-weight:bold;color:#003399">${inv.no}</div>
          <div style="font-size:11px;margin-top:4px">วันที่ออก: ${fmtDate(inv.date)}</div>
          <div style="font-size:11px">ครบกำหนด: ${fmtDate(inv.due)}</div>
          <div style="margin-top:6px"><span class="badge" style="background:${statusColors[inv.status]||'#333'};color:#FFF;border-color:${statusColors[inv.status]||'#333'}">${statusTH[inv.status]||inv.status}</span></div>
        </div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:14px">
        <div>
          <div style="font-size:11px;font-weight:bold;color:#003399;border-bottom:1px solid #003399;margin-bottom:4px">ผู้ออก Invoice</div>
          <div style="font-size:11px">บริษัท วัชร สตีวีโดริ่ง จำกัด<br>เลขทะเบียนนิติบุคคล: 0105542084141</div>
        </div>
        <div>
          <div style="font-size:11px;font-weight:bold;color:#003399;border-bottom:1px solid #003399;margin-bottom:4px">ลูกค้า (Bill To)</div>
          <div style="font-size:11px"><b>${inv.customer}</b><br>${inv.addr||''}<br>${inv.tel?'โทร: '+inv.tel:''}</div>
        </div>
      </div>
      <table class="ivp-tbl">
        <thead><tr><th style="width:40px">#</th><th>รายการสินค้า</th><th style="width:60px;text-align:right">จำนวน</th><th style="width:100px;text-align:right">ราคา/หน่วย (฿)</th><th style="width:110px;text-align:right">รวม (฿)</th></tr></thead>
        <tbody>
          ${inv.items.map((it,i)=>`<tr><td class="tc">${i+1}</td><td>${it.name}</td><td class="tr num">${it.qty}</td><td class="tr num">${fmt(it.price)}</td><td class="tr num"><b>${fmt(it.total)}</b></td></tr>`).join('')}
        </tbody>
      </table>
      <div style="display:flex;justify-content:flex-end">
        <div style="min-width:240px;border:1px solid #808080;padding:10px;background:#F8F5F0;margin-top:8px">
          <div class="trow"><span>ยอดรวมก่อนภาษี</span><span class="num">${fmt(inv.subtotal)}</span></div>
          <div class="trow"><span>ภาษีมูลค่าเพิ่ม ${inv.vat}%</span><span class="num">${fmt(inv.vatAmt)}</span></div>
          ${inv.discount?`<div class="trow"><span>ส่วนลด</span><span class="num">-${fmt(inv.discount)}</span></div>`:''}
          <div class="trow grand"><span>&#9654; ยอดสุทธิ</span><span class="num">${fmt(inv.total)}</span></div>
        </div>
      </div>
      ${inv.note?`<div style="margin-top:14px;border:1px solid #CCC;padding:8px;font-size:11px"><b>หมายเหตุ:</b> ${inv.note}</div>`:''}
      <div style="margin-top:20px;display:grid;grid-template-columns:1fr 1fr;gap:20px;font-size:11px;text-align:center">
        <div style="border-top:1px solid #808080;padding-top:4px">ลายมือชื่อผู้ออก Invoice</div>
        <div style="border-top:1px solid #808080;padding-top:4px">ลายมือชื่อผู้รับ</div>
      </div>
    </div>
  `;
  navigate('invoice-view');
}

// ======== INVOICE CREATE ========
let invRowCounter = 0;
function renderInvoiceCreate(){
  invRowCounter=0;
  currentInvoiceRows=[];
  document.getElementById('inv-row-body').innerHTML='';
  const now=new Date();
  document.getElementById('new-inv-no').value='INV-2026-00'+(invoices.length+1);
  document.getElementById('new-inv-date').valueAsDate=now;
  const due=new Date(); due.setDate(due.getDate()+30);
  document.getElementById('new-inv-due').valueAsDate=due;
  document.getElementById('new-inv-customer').value='';
  document.getElementById('new-inv-addr').value='';
  document.getElementById('new-inv-tel').value='';
  document.getElementById('new-inv-email').value='';
  document.getElementById('new-inv-note').value='ชำระเงินภายใน 30 วัน';
  document.getElementById('inv-discount').value=0;
  calcInvoice();
  addInvoiceRow();
}

function addInvoiceRow(){
  const rowId='irow-'+invRowCounter++;
  const opts=products.map(p=>`<option value="${p.id}" data-price="${p.sellPrice}">${p.code} — ${p.name}</option>`).join('');
  const tr=document.createElement('tr');
  tr.id=rowId;
  tr.innerHTML=`
    <td class="tc">${document.getElementById('inv-row-body').children.length+1}</td>
    <td><select class="inv-psel" onchange="fillRowPrice(this)">${opts}</select></td>
    <td><input type="text" placeholder="รายละเอียด..." style="border:1px solid #9898A0;padding:2px 4px;font-family:inherit;font-size:11px;background:#FFF;width:100%"></td>
    <td><input type="number" class="inv-qty" value="1" min="1" style="border:1px solid #9898A0;padding:2px 4px;font-family:inherit;font-size:11px;width:60px;text-align:right" onchange="calcInvoice()"></td>
    <td><input type="number" class="inv-price" value="${products[0]?products[0].sellPrice:0}" step="0.01" min="0" style="border:1px solid #9898A0;padding:2px 4px;font-family:inherit;font-size:11px;width:90px;text-align:right" onchange="calcInvoice()"></td>
    <td><input type="text" class="inv-line-total" readonly style="border:1px solid #9898A0;padding:2px 4px;font-family:inherit;font-size:11px;width:100px;text-align:right;background:#F0F5FF;font-weight:bold"></td>
    <td><button class="btn btn-d btn-sm" onclick="this.closest('tr').remove();renumberRows();calcInvoice()">&#10006;</button></td>
  `;
  document.getElementById('inv-row-body').appendChild(tr);
  calcInvoice();
}

function fillRowPrice(sel){
  const row=sel.closest('tr');
  const p=products.find(x=>String(x.id)===String(sel.value));
  if(p){ row.querySelector('.inv-price').value=p.sellPrice; }
  calcInvoice();
}

function renumberRows(){
  document.querySelectorAll('#inv-row-body tr').forEach((tr,i)=>{ tr.cells[0].textContent=i+1; });
}

function calcInvoice(){
  let sub=0;
  document.querySelectorAll('#inv-row-body tr').forEach(tr=>{
    const qty=parseFloat(tr.querySelector('.inv-qty')?tr.querySelector('.inv-qty').value:0)||0;
    const price=parseFloat(tr.querySelector('.inv-price')?tr.querySelector('.inv-price').value:0)||0;
    const total=qty*price;
    const lt=tr.querySelector('.inv-line-total');
    if(lt) lt.value=fmt(total);
    sub+=total;
  });
  const vatRate=parseFloat(v('new-inv-vat'))||7;
  const vatAmt=sub*(vatRate/100);
  const discount=parseFloat(v('inv-discount'))||0;
  const total=sub+vatAmt-discount;
  document.getElementById('inv-sub').textContent=fmt(sub);
  document.getElementById('inv-vat-lbl').textContent='ภาษีมูลค่าเพิ่ม '+vatRate+'%';
  document.getElementById('inv-vat-amt').textContent=fmt(vatAmt);
  document.getElementById('inv-total').textContent=fmt(total);
}

async function saveInvoice(status='draft'){
  const no=v('new-inv-no'),customer=v('new-inv-customer');
  if(!no||!customer){ alert('กรุณาระบุเลขที่ Invoice และชื่อลูกค้า'); return; }
  const rows=document.querySelectorAll('#inv-row-body tr');
  if(!rows.length){ alert('กรุณาเพิ่มรายการสินค้าอย่างน้อย 1 รายการ'); return; }
  const items=[];
  rows.forEach(tr=>{
    const pid=tr.querySelector('.inv-psel')? tr.querySelector('.inv-psel').value:'';
    const p=products.find(x=>String(x.id)===String(pid));
    const qty=parseFloat(tr.querySelector('.inv-qty').value)||0;
    const price=parseFloat(tr.querySelector('.inv-price').value)||0;
    const descInput = tr.querySelector('td:nth-child(3) input');
    items.push({
      product_id: pid ? parseInt(pid) : null,
      product_name: p ? p.name : 'สินค้า',
      quantity: Math.max(1, Math.round(qty)),
      unit_price: price,
      description: descInput ? descInput.value : '',
    });
  });

  try {
    await apiFetch('/api/invoices', {
      method: 'POST',
      body: JSON.stringify({
        invoice_no: no,
        customer_name: customer,
        customer_address: v('new-inv-addr') || '',
        customer_tel: v('new-inv-tel') || '',
        customer_email: v('new-inv-email') || '',
        invoice_date: v('new-inv-date'),
        due_date: v('new-inv-due'),
        vat_rate: parseFloat(v('new-inv-vat'))||7,
        discount: parseFloat(v('inv-discount'))||0,
        note: v('new-inv-note') || '',
        status,
        items,
      }),
    });

    await loadBootstrapData();
    showStatus('&#9989; บันทึก Invoice '+no+' เรียบร้อยแล้ว');
    navigate('invoice');
  } catch (error) {
    alert(error.message || 'บันทึก Invoice ไม่สำเร็จ');
  }
}

// ======== HELPERS ========
function fmt(n){ return parseFloat(n||0).toLocaleString('th-TH',{minimumFractionDigits:2,maximumFractionDigits:2}); }
function fmtDate(d){ if(!d) return '—'; try{ return new Date(d).toLocaleDateString('th-TH',{year:'numeric',month:'short',day:'numeric'}); }catch(e){ return d; } }
function v(id){ const e=document.getElementById(id); return e?e.value:''; }
function clearForm(ids){ ids.forEach(id=>{ const e=document.getElementById(id); if(e) e.value=''; }); }

function stockBadge(p){
  if(p.stock===0) return '<span class="badge bor">หมดสต็อก</span>';
  if(p.stock<=p.minStock) return '<span class="badge bow">ใกล้หมด</span>';
  return '<span class="badge bog">ปกติ</span>';
}

function invBadge(status){
  const map={
    'draft':'<span class="badge bogy">ร่าง</span>',
    'sent':'<span class="badge boi">ส่งแล้ว</span>',
    'paid':'<span class="badge bog">ชำระแล้ว</span>',
    'overdue':'<span class="badge bor">เกินกำหนด</span>',
  };
  return map[status]||`<span class="badge bogy">${status}</span>`;
}

function openModal(id){ document.getElementById(id).classList.add('show'); }
function closeModal(id){ document.getElementById(id).classList.remove('show'); }

function printPage(){ window.print(); }

function exportInvoicePDF(){
  const element = document.getElementById('invoice-print-area');
  const invoiceNo = document.getElementById('iv-title').textContent.replace('Invoice — ', '');
  const opt = {
    margin: 10,
    filename: invoiceNo + '.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { orientation: 'portrait', unit: 'mm', format: 'a4' }
  };
  html2pdf().set(opt).from(element).save();
  showStatus('✓ ดาวน์โหลด PDF ' + invoiceNo + ' เรียบร้อย');
}

// ======== INIT ========
document.addEventListener('DOMContentLoaded', async function(){
  const loginForm=document.getElementById('login-form');
  if(loginForm){
    loginForm.addEventListener('submit',loginSubmit);
  }
  document.getElementById('sb-scroll').textContent=
    '&#9733; บริษัท วัชร สตีวีโดริ่ง จำกัด (WACHARA STEVEDORING COMPANY LIMITED) &nbsp;&nbsp;&nbsp; '+
    'ธุรกิจรับขนถ่ายสินค้าในท่าเรือ และจำหน่ายอุปกรณ์ไฟฟ้าสำหรับให้แสงสว่าง &nbsp;&nbsp;&nbsp; '+
    'รองรับ PHP / Laravel 12 &nbsp;&nbsp;&nbsp; Database: MySQL / XAMPP &nbsp;&nbsp;&nbsp; &#9733; ';

  try {
    await loadBootstrapData();
    hideLogin();
    navigate('dashboard');
  } catch (_e) {
    showLogin();
  }

  updateStatusBar();
});

// Keyboard shortcuts
document.addEventListener('keydown',function(e){
  if(e.key==='Escape'){
    document.querySelectorAll('.mback.show').forEach(m=>m.classList.remove('show'));
  }
});
</script>

</body>
</html>
