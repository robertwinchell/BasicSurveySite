using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Newtonsoft.Json;
using Quiz.Web.Models;
//using Quiz.DL;
using Quiz.BL;
using System.Configuration;
using Quiz.DL;


namespace Quiz.Web.Controllers
{
    public class HomeController : Controller
    {
        UserBL objuserbl = new UserBL();
        public ActionResult Index()
        {
            ViewBag.Message = "Modify this template to jump-start your ASP.NET MVC application.";

            return View();
        }

        public ActionResult About()
        {
            ViewBag.Message = "Your app description page.";

            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.Message = "Your contact page.";

            return View();
        }


        //[HttpPost]
        public ActionResult InsertUser(List<UserModel> UserList)
        {
            string json = JsonConvert.SerializeObject(UserList);
            //write string to file
            string fullPath = Path.Combine(Server.MapPath("~/dynamicfolder/User.js"));
            System.IO.File.WriteAllText(fullPath, json);
            return Json(true, JsonRequestBehavior.AllowGet);
        }


        public ActionResult InsertAnswer(List<AnswerModel> AnswerList)
        {
            string json = JsonConvert.SerializeObject(AnswerList);
            //write string to file
            string fullPath = Path.Combine(Server.MapPath("~/dynamicfolder/UserAnswer.js"));
            System.IO.File.WriteAllText(fullPath, json);
            return Json(true, JsonRequestBehavior.AllowGet);
        }

        [HttpPost]
        public ActionResult Upload(FormCollection formdata)
        {

            try
            {
                HomeModel model = new HomeModel();
                int Userid = Convert.ToInt32(formdata["Userid"]);
                string email = Convert.ToString(formdata["Useremail"]);
                string name = string.Empty;
                if (Request.Files.Count > 0)
                {
                    List<string> exts = new List<string>();
                    exts.Add(".gif");
                    exts.Add(".jpg");
                    exts.Add(".jpeg");
                    exts.Add(".bmp");
                    exts.Add(".png");
                    var file = Request.Files[0];
                    if (exts.Contains(System.IO.Path.GetExtension(file.FileName).ToLower()))
                    {
                        //Random rnd = new Random();
                        //name = rnd.Next(111, 9999).ToString() + "_" + System.IO.Path.GetFileName(file.FileName);
                        //name = name.Replace("-", "_");

                        name = Userid + "_" + System.IO.Path.GetFileName(file.FileName);
                        string fullPath = Path.Combine(Server.MapPath("~/dynamicfolder/UserAnswerImage"), name);
                        file.SaveAs(fullPath);
                        var data = objuserbl.UpdateUser(Userid, email, name, false);

                    }
                }


                return Json(name, JsonRequestBehavior.AllowGet);
            }
            catch
            {
                return View("~/Views/Shared/Error.cshtml");
            }
        }

        //[HttpPost]
        public ActionResult SendMessage(FormCollection formdata)
        {
            int result = 0;
            bool message = false;
            claCommon objCom = new claCommon();
            try
            {
                string UserEmail = Convert.ToString(formdata["UserEmail"]);
                string Message = Convert.ToString(formdata["Message"]);
                string body = "";
                body = "Dear Human Unit," + "<br />" + Message + "<br /><br />";
                body = body + "Thank you for participating, you will be allowed to continue exisiting!.<br /> ph'nglui mglw'nafh Cthulhu R'lyeh wgah'nagl fhtagn!";
                body = body + "With Regards,<br />";
                body = body + "Cthulhu";


                string subject = "Re :Quiz Score";
                result = objCom.SendMail(UserEmail, "R'lyeh@darkoceandepths.com", subject, body);
                if (result > 0)
                {
                    int Userid = Convert.ToInt32(formdata["Userid"]);
                    var data = objuserbl.UpdateUser(Userid, UserEmail, null, true);
                    message = true;
                }
                return Json(message, JsonRequestBehavior.AllowGet);
            }

            catch (Exception ex)
            {
                return Json(false, JsonRequestBehavior.AllowGet);
            }
        }

        public ActionResult InsertUpdateUser(FormCollection formdata)
        {
            string UserEmail = Convert.ToString(formdata["UserEmail"]);
            var data = objuserbl.SaveUser(UserEmail, null, false);
            return Json(data, JsonRequestBehavior.AllowGet);
        }
    }
}
