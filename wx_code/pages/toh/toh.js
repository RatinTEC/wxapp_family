// pages/toh/toh.js
//获取应用实例
const app = getApp();
Page({
  /**
   * 页面的初始数据
   */
  data: {
    args: {
        action:"list"
    },
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var date = new Date();
    this.data.args  = options;
    this.config = wx.getStorageSync('config');
    if (this.data.args.action == "detail" && wx.getStorageSync("toh_detail" + this.data.args.eid)){
        var dataset = wx.getStorageSync("toh_detail" + this.data.args.eid);
        this.setData({
          "action": this.data.args.action,
          "result": dataset,
        });
    } else if (this.data.args.action != "detail" && wx.getStorageSync("toh_list" + date.getUTCMonth() + "-" + date.getUTCDate())){
      var dataset = wx.getStorageSync("toh_list" + date.getUTCMonth() + "-" + date.getUTCDate());
      this.setData({
        "action": this.data.args.action,
        "result": dataset,
      });
    }else{
      wx.request({
        url: this.config.domain + '/family/index.php?method=todayonhistory',
        data:this.data.args,
        success:function(res){
          this.setData({
            "action": this.data.args.action,
            "result": res.data.result,
          });
          switch (this.data.args.action) {
            case ("detail"):
              wx.setStorageSync("toh_detail" + res.data.result[0].e_id, res.data.result);
            break;
            default:
              wx.setStorageSync("toh_list"+date.getUTCMonth()+"-"+date.getUTCDate(), res.data.result);
            break;
          };
        }.bind(this)
      });
    }
  },
  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
  
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
    app.pagevisited(this);
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {
  
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {
  
  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
  
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
  
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  
  },
  detail:function(event){
    wx.navigateTo({
      url: '../toh/toh?action=detail&eid=' + event.currentTarget.dataset.eid,
    });
  }
})