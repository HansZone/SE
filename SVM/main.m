%% This is the main function of SVM classfier.

clear all;
use_spider; %Initialize spider toolbox.
model = svm_train; %Train the SVM

%for s=1:49  %% Loop for picking up data files
    %l = int2str(s);
    %str = strcat('C:\Documents and Settings\Rahul R S\Desktop\data\', l,'.txt');  
    
    % Read data from the csv file
    price_data = dlmread('1.csv');

    for w1=1:200
        price_reverse(w1) = price_data(201-w1);
    end

    % Sampling to fix test date to the same size of train data.
    k=1;
    for i = 1:16:182
        % Calculate the sum of every 16 days and get 12 data groups.
        test_data(k)= sum(price_reverse(i:i+15));
        k = k+1;
    end
    
    % Nomarlize the test data
    test_data = test_data/max(test_data);
    
    predict_function(test_data,model,10);  % function to calculate and write the result to a file.