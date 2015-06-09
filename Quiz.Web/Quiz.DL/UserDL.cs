using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Quiz.DL
{
    public class UserDL
    {
        public int? SaveUser(string email, string image)
        {
            int? ret = 0;
            try
            {
                var db = new QuizEntities();
                var user = new User
                {
                    Email = email,
                    Image = image,
                };
                db.Users.Add(user);
                db.SaveChanges();
                ret= user.ID;
            }
            catch (Exception ex)
            {

            }
            return ret;
        }

    }
}
