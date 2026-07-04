/* =====================================================
   HEADER
===================================================== */

.topbar{

    position:fixed;

    top:0;

    left:0;

    width:100%;

    height:70px;

    background:#111827;

    border-bottom:1px solid #334155;

    display:flex;

    align-items:center;

    justify-content:space-between;

    padding:0 20px;

    z-index:1000;

}

.topbar-left{

    display:flex;

    align-items:center;

    gap:15px;

}

.topbar-center{

    flex:1;

    display:flex;

    justify-content:center;

}

.topbar-right{

    display:flex;

    align-items:center;

}

.logo{

    font-size:24px;

    font-weight:700;

    color:#F8FAFC;

}

.logo span{

    color:#06B6D4;

}

.menu-button{

    width:42px;

    height:42px;

    border:none;

    border-radius:10px;

    background:transparent;

    color:#F8FAFC;

    font-size:22px;

    cursor:pointer;

    transition:.3s;

}

.menu-button:hover{

    background:#1F2937;

}

.search-box{

    width:100%;

    max-width:400px;

    height:42px;

    padding:0 15px;

    border:1px solid #334155;

    border-radius:10px;

    background:#1F2937;

    color:#F8FAFC;

}

.search-box:focus{

    outline:none;

    border-color:#06B6D4;

}

.user-info{

    display:flex;

    align-items:center;

    gap:12px;

}

.avatar{

    width:42px;

    height:42px;

    border-radius:50%;

    background:#06B6D4;

    display:flex;

    align-items:center;

    justify-content:center;

    color:#FFF;

    font-weight:bold;

    font-size:18px;

}

.user-info small{

    display:block;

    color:#94A3B8;

}