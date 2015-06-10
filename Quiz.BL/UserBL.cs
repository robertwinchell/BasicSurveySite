using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Quiz.DL;

namespace Quiz.BL
{
    public class UserBL
    {
        UserDL objuser = new UserDL();

        public int? SaveUser(string email, string image, bool completed)
        {
            var user = objuser.SaveUser(email, image, completed);
            return user;
        }

        public int UpdateUser(int ID, string email, string image, bool completed)
        {
            var user = objuser.UpdateUser(ID, email, image, completed);
            return user;
        }
    }
}
