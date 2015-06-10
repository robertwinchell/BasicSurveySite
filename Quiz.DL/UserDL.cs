using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Quiz.DL
{
    public class UserDL
    {
        public int? SaveUser(string email, string image, bool completed)
        {
            int? ret = 0;
            try
            {
                var db = new QuizContainer();
                var user = new User
                {
                    Email = email,
                    Image = image,
                    Completed = completed,
                };
                db.Users.Add(user);
                db.SaveChanges();
                ret = user.ID;
            }
            catch (Exception ex)
            {

            }
            return ret;
        }


        public int UpdateUser(int ID, string email, string image, bool completed)
        {
            int ret = 0;
            var db = new QuizContainer();
            var result = db.Users.Where(a => a.ID == ID).FirstOrDefault();
            if (result != null)
            {
                result.ID = ID;
                result.Email = email;
                if (!string.IsNullOrEmpty(image))
                {
                    result.Image = image;
                }
                else
                {
                    result.Image = result.Image;
                }
                result.Completed = completed;
                db.SaveChanges();
                ret = result.ID;
            }
            return ret;
        }
    }
}
