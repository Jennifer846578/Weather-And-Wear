import numpy as np
import math
import os
import pickle
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
def save_weights(data, file):
    with open(file, "wb") as f:
        pickle.dump(data, f)

def load_weights(file):
    if not os.path.exists(file):
        with open(file, "wb") as f:  # Ensure the file is created correctly
            pickle.dump({
                "C":0.3,
                "W":0.4,
                "S":0.3,
                }, f)
    with open(file, "rb") as f:                                                                                                                             
        return pickle.load(f)


class PredictorScore:
    
    def __init__(self,user):
        # Initialize global weights
        # Start with equal weights

        # Hyperparameters
        self.weightsfile=os.path.join(BASE_DIR,'Weights',f"user{'0'*(3-len(str(user)))+str(user)}.pkl")
        self.alpha=0.4   # Learning rate for weights
        self.beta=0.4   # Learning rate for scores
        self.lambda_smooth=0.5  # Smoothing factor for weight updates
        self.gamma=1 #for high scores changes
        self.weights=load_weights(self.weightsfile)

    def predict_score(self,C, S, W):
        return self.weights["C"] * C + self.weights["S"] * S + self.weights["W"] * W

    def update_weights_and_scores(self,C, S, W, R):

        P = self.predict_score(C, S, W)  # Predicted score
        E = P - R  # Error

        # if abs(E) < 0.5:  # If error is small, no major update needed
        #     return C, S, W
            
        # Update weights using gradient descent
        new_W_C = self.weights["C"] - self.alpha * E * (abs(R-C)+1)
        new_W_S = self.weights["S"] - self.alpha * E * (abs(R-S)+1)
        new_W_W = self.weights["W"] - self.alpha * E * (abs(R-W)+1)

        total=math.exp(new_W_C)+math.exp(new_W_W)+math.exp(new_W_S)
        new_W_C=math.exp(new_W_C)/total
        new_W_S=math.exp(new_W_S)/total
        new_W_W=math.exp(new_W_W)/total

        # # Normalize weights
        # total = new_W_C + new_W_S + new_W_W
        # new_W_C, new_W_S, new_W_W = new_W_C / total, new_W_S / total, new_W_W / total

        # Apply smoothing (Exponential Moving Average)
        self.weights["C"] = self.lambda_smooth * self.weights["C"] + (1 - self.lambda_smooth) * new_W_C
        self.weights["S"] = self.lambda_smooth * self.weights["S"] + (1 - self.lambda_smooth) * new_W_S
        self.weights["W"] = self.lambda_smooth * self.weights["W"] + (1 - self.lambda_smooth) * new_W_W


        # Adjust scores slightly if needed
        if(abs(E)>=0.5):
            meanCSW=abs(C-R)+abs(S-R)+abs(W-R)
            C = np.clip(C - self.beta * E * self.weights["C"] * (1 + self.gamma * abs(C-R) ), 1, 5)
            S = np.clip(S - self.beta * E * self.weights["S"] * (1 + self.gamma * abs(S-R) ), 1, 5)
            W = np.clip(W - self.beta * E * self.weights["W"] * (1 + self.gamma * abs(W-R) ), 1, 5)
        save_weights(self.weights,self.weightsfile)

        return C, S, W  # Return updated scores
