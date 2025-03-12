import os
import pickle
BASE_DIR = os.path.dirname(os.path.abspath(__file__))  # Get the script's directory
CSCORES_PATH = os.path.join(BASE_DIR, "Cscores", "CscoreTemplate.pkl")
def save_C(data, user):
    file = os.path.join(BASE_DIR, "Cscores", "userCscores", f"user{'0'*(3-len(str(user)))+str(user)}.pkl")  
    with open(file,"wb") as f:
        pickle.dump(data, f)

def load_C(user):
    file = os.path.join(BASE_DIR, "Cscores", "userCscores", f"user{'0'*(3-len(str(user)))+str(user)}.pkl")
    if not os.path.exists(file):
        # with open('Cscores/CscoreTemplate.pkl',"rb") as f:  # Ensure the file is created correctly
        #     return pickle.load(f)
        if not os.path.exists(CSCORES_PATH):
            raise FileNotFoundError(f"Template file not found: {CSCORES_PATH}")  # Debugging line
        with open(CSCORES_PATH, "rb") as f:
            return pickle.load(f)

    with open(file,"rb") as f:
        return pickle.load(f)



class PredictCombinationScore:
    def __init__(self,user):
        self.user=user
    
    def predict_score_C(self,outer,top,bottom):
        CList=load_C(self.user)
        for x in range(len(CList)):
            if(CList[x][0].lower()==outer and CList[x][1].lower()==top and CList[x][2].lower()==bottom):
                return CList[x][3]

    def update_score_C(self,outer,top,bottom,score):
        CList=load_C(self.user)
        for x in range(len(CList)):
            if(CList[x][0].lower()==outer and CList[x][1].lower()==top and CList[x][2].lower()==bottom):
                CList[x][3]=score
                save_C(CList,self.user)
                return