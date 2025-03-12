# import os
# import pandas as pd
# import joblib
# import pickle
# import numpy as np
# from river import tree
# from sklearn.preprocessing import OneHotEncoder

# BASE_DIR = os.path.dirname(os.path.abspath(__file__))

# class OneHotEncodingHandler:
#     def __init__(self, encoder_path=os.path.join(BASE_DIR, "models", "onehot_encoder.pkl")):
#         self.encoder_path = encoder_path
#         self.encoder = OneHotEncoder(handle_unknown="ignore", sparse_output=False)
#         self.feature_names = None
        
#         if os.path.exists(self.encoder_path):
#             self.load_encoder()

#     def fit_encoder(self, df, categorical_cols):
#         self.encoder.fit(df[categorical_cols])
#         self.feature_names = self.encoder.get_feature_names_out(categorical_cols)
#         self.save_encoder()

#     def transform_data(self, df, categorical_cols):
#         encoded_array = self.encoder.transform(df[categorical_cols])
#         encoded_df = pd.DataFrame(encoded_array, columns=self.feature_names)
#         df_numeric = df.drop(columns=categorical_cols, errors='ignore')
#         return pd.concat([df_numeric, encoded_df], axis=1)

#     def save_encoder(self):
#         joblib.dump((self.encoder, self.feature_names), self.encoder_path)

#     def load_encoder(self):
#         self.encoder, self.feature_names = joblib.load(self.encoder_path)

# class UserOutfitModel:
#     def __init__(self, user_id, default_data_path=os.path.join(BASE_DIR, "outfit_weather.csv")):
#         self.user_id = user_id
#         self.global_ht_model_path = os.path.join(BASE_DIR, "models", "global_ht_model.pkl")
#         self.ht_model_path = os.path.join(BASE_DIR, "models", f"ht_model_{user_id}.pkl")
#         self.data_path = os.path.join(BASE_DIR, "data", f"user_data_{user_id}.csv")
#         self.encoder_handler = OneHotEncodingHandler()

#         os.makedirs("models", exist_ok=True)
#         os.makedirs("data", exist_ok=True)

#         # Pastikan model global HT sudah dibuat
#         if not os.path.exists(self.global_ht_model_path):
#             self._train_global_ht(default_data_path)
        
#         # Load model HT user atau gunakan model global jika baru pertama kali
#         if os.path.exists(self.ht_model_path):
#             with open(self.ht_model_path, "rb") as f:
#                 self.ht_model = pickle.load(f)
#         else:
#             with open(self.global_ht_model_path, "rb") as f:
#                 self.ht_model = pickle.load(f)

#         self.data = pd.DataFrame()
#         self._load_or_initialize(default_data_path)

#     def _train_global_ht(self, data_path):
#         if not os.path.exists(data_path):
#             return

#         data = pd.read_csv(data_path)
#         if "rating" not in data.columns:
#             return

#         categorical_cols = [col for col in data.columns if data[col].dtype == "object"]
#         self.encoder_handler.fit_encoder(data, categorical_cols)
        
#         y = data["rating"]
#         X = self.encoder_handler.transform_data(data.drop(columns=["rating"], errors="ignore"), categorical_cols)

#         global_ht_model = tree.HoeffdingTreeRegressor(grace_period=10, max_depth=10, leaf_prediction="adaptive")
#         for i in range(len(X)):
#             global_ht_model.learn_one(X.iloc[i].to_dict(), y.iloc[i])
        
#         with open(self.global_ht_model_path, "wb") as f:
#             pickle.dump(global_ht_model, f)

#     def _load_or_initialize(self, default_data_path):
#         if os.path.exists(self.ht_model_path) and os.path.exists(self.data_path):
#             with open(self.ht_model_path, "rb") as f:
#                 self.ht_model = pickle.load(f)
#             self.data = pd.read_csv(self.data_path)
#         else:
#             self.data = pd.read_csv(default_data_path) if os.path.exists(default_data_path) else pd.DataFrame()
#             if not self.data.empty:
#                 categorical_cols = [col for col in self.data.columns if self.data[col].dtype == "object"]
#                 X = self.encoder_handler.transform_data(self.data, categorical_cols)
#                 y = self.data["rating"]
#                 for i in range(len(X)):
#                     self.ht_model.learn_one(X.iloc[i].to_dict(), y.iloc[i])
#         self._save_models()

#     def update_online_model(self, new_data):
#         new_data_df = pd.DataFrame([new_data])
#         categorical_cols = [col for col in new_data_df.columns if new_data_df[col].dtype == "object"]
#         new_data_encoded = self.encoder_handler.transform_data(new_data_df.drop(columns=["rating"], errors="ignore"), categorical_cols)

#         if not os.path.exists(self.data_path):
#             self.data = new_data_df
#         else:
#             self.data = pd.read_csv(self.data_path)
#             self.data = pd.concat([self.data, new_data_df], ignore_index=True)

#         self.ht_model.learn_one(new_data_encoded.iloc[0].to_dict(), new_data["rating"])

#         if len(self.data) > 500:
#             X = self.encoder_handler.transform_data(self.data.drop(columns=["rating"], errors="ignore"), categorical_cols)
#             y_true = self.data["rating"]
#             y_pred = [self.ht_model.predict_one(row.to_dict()) for _, row in X.iterrows()]
#             residuals = np.abs(y_true - y_pred)
#             worst_idx = residuals.idxmax()
#             self.data = self.data.drop(index=worst_idx).reset_index(drop=True)

#         self.data.to_csv(self.data_path, index=False)
#         self._save_models()

#     def predict_outfit_rating(self, outfit_data):
#         outfit_df = pd.DataFrame([outfit_data])
#         categorical_cols = [col for col in outfit_df.columns if outfit_df[col].dtype == "object"]
#         outfit_encoded = self.encoder_handler.transform_data(outfit_df, categorical_cols)
        
#         ht_pred = self.ht_model.predict_one(outfit_encoded.iloc[0].to_dict())

#         return ht_pred

#     def _save_models(self):
#         with open(self.ht_model_path, "wb") as f:
#             pickle.dump(self.ht_model, f)

# import os
# import pandas as pd
# import joblib
# import pickle
# import numpy as np
# from river import tree
# from sklearn.preprocessing import OneHotEncoder

# BASE_DIR = os.path.dirname(os.path.abspath(__file__))

# class OneHotEncodingHandler:
#     def __init__(self, encoder_path=os.path.join(BASE_DIR, "models", "onehot_encoder.pkl")):
#         self.encoder_path = encoder_path
#         self.encoder = OneHotEncoder(handle_unknown="ignore", sparse_output=False)
#         self.feature_names = None
        
#         if os.path.exists(self.encoder_path):
#             self.load_encoder()

#     def fit_encoder(self, df, categorical_cols):
#         self.encoder.fit(df[categorical_cols])
#         self.feature_names = self.encoder.get_feature_names_out(categorical_cols)
#         self.save_encoder()

#     def transform_data(self, df, categorical_cols):
#         encoded_array = self.encoder.transform(df[categorical_cols])
#         encoded_df = pd.DataFrame(encoded_array, columns=self.feature_names)
#         df_numeric = df.drop(columns=categorical_cols, errors='ignore')
#         return pd.concat([df_numeric, encoded_df], axis=1)

#     def save_encoder(self):
#         joblib.dump((self.encoder, self.feature_names), self.encoder_path)

#     def load_encoder(self):
#         self.encoder, self.feature_names = joblib.load(self.encoder_path)

# class UserOutfitModel:
#     def __init__(self, user_id, default_data_path=os.path.join(BASE_DIR, "outfit_weather.csv")):
#         self.user_id = user_id
#         self.global_ht_model_path = os.path.join(BASE_DIR, "models", "global_ht_model.pkl")
#         self.ht_model_path = os.path.join(BASE_DIR, "models", f"ht_model_{user_id}.pkl")
#         self.encoder_handler = OneHotEncodingHandler()

#         os.makedirs("models", exist_ok=True)
        
#         if not os.path.exists(self.global_ht_model_path):
#             self._train_global_ht(default_data_path)
        
#         if os.path.exists(self.ht_model_path):
#             with open(self.ht_model_path, "rb") as f:
#                 self.ht_model = pickle.load(f)
#         else:
#             with open(self.global_ht_model_path, "rb") as f:
#                 self.ht_model = pickle.load(f)
    
#     def _train_global_ht(self, data_path):
#         if not os.path.exists(data_path):
#             return

#         data = pd.read_csv(data_path)
#         if "rating" not in data.columns:
#             return

#         categorical_cols = [col for col in data.columns if data[col].dtype == "object"]
#         self.encoder_handler.fit_encoder(data, categorical_cols)
        
#         y = data["rating"]
#         X = self.encoder_handler.transform_data(data.drop(columns=["rating"], errors="ignore"), categorical_cols)

#         global_ht_model = tree.HoeffdingTreeRegressor(grace_period=10, max_depth=10, leaf_prediction="adaptive")
#         for i in range(len(X)):
#             global_ht_model.learn_one(X.iloc[i].to_dict(), y.iloc[i])
        
#         with open(self.global_ht_model_path, "wb") as f:
#             pickle.dump(global_ht_model, f)
    
#     def update_online_model(self, new_data):
#         new_data_df = pd.DataFrame([new_data])
#         categorical_cols = [col for col in new_data_df.columns if new_data_df[col].dtype == "object"]
#         new_data_encoded = self.encoder_handler.transform_data(new_data_df.drop(columns=["rating"], errors="ignore"), categorical_cols)
        
#         self.ht_model.learn_one(new_data_encoded.iloc[0].to_dict(), new_data["rating"])
#         self._save_model()
    
#     def predict_outfit_rating(self, outfit_data):
#         outfit_df = pd.DataFrame([outfit_data])
#         categorical_cols = [col for col in outfit_df.columns if outfit_df[col].dtype == "object"]
#         outfit_encoded = self.encoder_handler.transform_data(outfit_df, categorical_cols)
        
#         ht_pred = self.ht_model.predict_one(outfit_encoded.iloc[0].to_dict())
#         return np.clip(ht_pred,1,5)

#     def _save_model(self):
#         with open(self.ht_model_path, "wb") as f:
#             pickle.dump(self.ht_model, f)


import os
import pandas as pd
import joblib
import pickle
import numpy as np
from river import tree
from sklearn.preprocessing import OneHotEncoder

BASE_DIR = os.path.dirname(os.path.abspath(__file__))

class OneHotEncodingHandler:
    def __init__(self, encoder_path=os.path.join(BASE_DIR, "models", "onehot_encoder.pkl")):
        self.encoder_path = encoder_path
        self.encoder = OneHotEncoder(handle_unknown="ignore", sparse_output=False)
        self.feature_names = None
        
        if os.path.exists(self.encoder_path):
            self.load_encoder()

    def fit_encoder(self, df, categorical_cols):
        self.encoder.fit(df[categorical_cols])
        self.feature_names = self.encoder.get_feature_names_out(categorical_cols)
        self.save_encoder()

    def transform_data(self, df, categorical_cols):
        encoded_array = self.encoder.transform(df[categorical_cols])
        encoded_df = pd.DataFrame(encoded_array, columns=self.feature_names)
        df_numeric = df.drop(columns=categorical_cols, errors='ignore')
        return pd.concat([df_numeric, encoded_df], axis=1)

    def save_encoder(self):
        joblib.dump((self.encoder, self.feature_names), self.encoder_path)

    def load_encoder(self):
        self.encoder, self.feature_names = joblib.load(self.encoder_path)

class UserOutfitModel:
    def __init__(self, user_id, default_data_path=os.path.join(BASE_DIR, "outfit_weather.csv")):
        self.user_id = user_id
        self.global_ht_model_path = os.path.join(BASE_DIR, "models", "global_ht_model.pkl")
        self.ht_model_path = os.path.join(BASE_DIR, "models", f"ht_model_{user_id}.pkl")
        self.encoder_handler = OneHotEncodingHandler()

        os.makedirs("models", exist_ok=True)
        
        if not os.path.exists(self.global_ht_model_path):
            self._train_global_ht(default_data_path)
        
        if os.path.exists(self.ht_model_path):
            with open(self.ht_model_path, "rb") as f:
                self.ht_model = pickle.load(f)
        else:
            with open(self.global_ht_model_path, "rb") as f:
                self.ht_model = pickle.load(f)
    
    def _train_global_ht(self, data_path):
        if not os.path.exists(data_path):
            return

        data = pd.read_csv(data_path)
        if "rating" not in data.columns:
            return

        categorical_cols = [col for col in data.columns if data[col].dtype == "object"]
        self.encoder_handler.fit_encoder(data, categorical_cols)
        
        y = data["rating"].astype(str)  # Mengubah target menjadi string untuk klasifikasi
        X = self.encoder_handler.transform_data(data.drop(columns=["rating"], errors="ignore"), categorical_cols)

        global_ht_model = tree.HoeffdingTreeClassifier(grace_period=10, max_depth=10)
        for i in range(len(X)):
            global_ht_model.learn_one(X.iloc[i].to_dict(), y.iloc[i])
        
        with open(self.global_ht_model_path, "wb") as f:
            pickle.dump(global_ht_model, f)
    
    def update_online_model(self, new_data):
        new_data_df = pd.DataFrame([new_data])
        categorical_cols = [col for col in new_data_df.columns if new_data_df[col].dtype == "object"]
        new_data_encoded = self.encoder_handler.transform_data(new_data_df.drop(columns=["rating"], errors="ignore"), categorical_cols)
        
        self.ht_model.learn_one(new_data_encoded.iloc[0].to_dict(), str(new_data["rating"]))  # Pastikan targetnya string
        self._save_model()
    
    def predict_outfit_rating(self, outfit_data):
        outfit_df = pd.DataFrame([outfit_data])
        categorical_cols = [col for col in outfit_df.columns if outfit_df[col].dtype == "object"]
        outfit_encoded = self.encoder_handler.transform_data(outfit_df, categorical_cols)
        
        ht_pred = self.ht_model.predict_one(outfit_encoded.iloc[0].to_dict())
        return int(ht_pred)  # Konversi hasil prediksi ke integer

    def _save_model(self):
        with open(self.ht_model_path, "wb") as f:
            pickle.dump(self.ht_model, f)
