//index.js
//获取应用实例
const app = getApp();
Page({
  data: {
    args              :{},
  }, 
  gotoToh:function(){
    wx.navigateTo({
      url: '../toh/toh',
    });
  },
  scanCode:function(){
    // 允许从相机和相册扫码
    wx.scanCode({
      success: (res) => {
        console.log(res)
      }
    })
  },
  gotoAlbum: function () {
    wx.navigateTo({
      url: '../album/album',
    })
  },
  wxlogin:function(){
    wx.openSetting({
      
    });
  },
  setdeadline:function(){
    var deadline = this.config.deadline;
    var secondnow = Date.parse(deadline);
    secondnow = secondnow / 1000;
    var timestamp = (new Date()).valueOf() / 1000;
    var secondleft = Math.floor(secondnow - timestamp);
    var day = Math.floor(secondleft / 86400);
    var hour = Math.floor(secondleft / 3600) % 24;
    var minute = Math.floor(secondleft / 60) % 60;
    var second = secondleft % 60;
    this.setData({
      "secondleft": secondleft,
      "day": day,
      "hour": hour,
      "minute": minute,
      "second": second,
      "userinfo": JSON.stringify(this.data.userInfo),
    });
  },
  onLoad: function (options) {
    setInterval(function () {
      this.setdeadline();
    }.bind(this), 1000);
    this.config = wx.getStorageSync('config') || [];
    var userInfo  = wx.getStorageSync('userInfo');
    var hasUserInfo = wx.getStorageSync('hasUserInfo');
    this.setData({
      "userInfo":userInfo,
      "hasUserInfo": hasUserInfo,
    });
  },
  onHide:function(){
    app.pagevisited(this);
  }
}); 