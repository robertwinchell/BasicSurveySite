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
       public int? SaveUser(string email, string image)
       {
           var user = objuser.SaveUser(email, image);
           return user;
       }
    }
}
